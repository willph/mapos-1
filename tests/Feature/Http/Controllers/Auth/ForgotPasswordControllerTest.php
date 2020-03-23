<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_forgot_password_form()
    {
        $response = $this->get(route('password.request'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.passwords.email');
    }

    /** @test */
    public function it_displays_validation_errors()
    {
        $response = $this->post('/password/reset', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_send_password_reset_email_and_redirects_user()
    {
        Notification::fake();

        $user = factory(User::class)->create();

        $response = $this
            ->from(route('login'))
            ->post(route('password.email'), [
                'email' => $user->email,
            ]);

        $response->assertRedirect(route('login'));
        Notification::assertSentTo($user, ResetPasswordNotification::class);
    }
}
