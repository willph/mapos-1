<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConfirmPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_confirm_password_form()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('password.confirm'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.passwords.confirm');
    }

    /** @test */
    public function it_displays_validation_errors()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/password/confirm', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function it_confirms_user_password_and_redirects()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->from('admin.dashboard')
            ->actingAs($user)
            ->post(route('password.confirm'), [
                'password' => 'password',
            ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.dashboard.index'));
    }
}
