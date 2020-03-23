<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_reset_password_form()
    {
        $response = $this->get(route('password.reset', [
            'token' => 'token'
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('auth.passwords.reset');
    }

    /** @test */
    public function it_displays_validation_errors()
    {
        $response = $this->post('/password/reset', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email', 'password', 'token']);
    }

    /** @test */
    public function it_resets_user_password_and_redirects()
    {
        Notification::fake();
        Event::fake();

        $user = factory(User::class)->create();

        $token = app('auth.password.broker')->createToken($user);

        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);

        $this->assertTrue(Hash::check('new_password', $user->fresh()->password));
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.dashboard.index'));

        Event::assertDispatched(PasswordReset::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }
}
