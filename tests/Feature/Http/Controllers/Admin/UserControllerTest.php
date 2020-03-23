<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_user_list()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.index');
    }

    /** @test */
    public function it_displays_a_specific_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.users.show', $user->getKey()));

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.show');
        $response->assertViewHas('user', function ($loadedUser) use ($user) {
            return $loadedUser->getKey() === $user->getKey();
        });
    }

    /** @test */
    public function it_displays_user_create_form()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.users.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.create');
    }

    /** @test */
    public function it_displays_validation_errors_on_create()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('admin.users.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email', 'name', 'password']);
    }

    /** @test */
    public function it_creates_a_user_and_redirects()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('admin.users.store'), [
            'name' => 'Teste Teste',
            'email' => 'teste@teste.com',
            'password' => 'teste123',
            'password_confirmation' => 'teste123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'Teste Teste',
            'email' => 'teste@teste.com',
        ]);
    }

    /** @test */
    public function it_displays_user_edit_form()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.users.edit', [
            'user' => $user->getKey(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.edit');
    }

    /** @test */
    public function it_displays_validation_errors_on_edit()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->put(route('admin.users.update', [
                'user' => $user->getKey(),
        ]), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email', 'name']);
    }

    /** @test */
    public function it_displays_password_validation_errors_on_edit()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->put(route('admin.users.update', [
            'user' => $user->getKey(),
        ]), [
            'password' => 'small',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function it_updates_a_user_and_redirects()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->put(route('admin.users.update', [
            'user' => $user->getKey(),
        ]), [
            'name' => 'New name',
            'email' => 'mail@mail.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.users.index'));
        $this->assertEquals('New name', $user->fresh()->name);
        $this->assertEquals('mail@mail.com', $user->fresh()->email);
    }

    /** @test */
    public function it_can_deletes_a_user()
    {
        [$user, $userToDelete] = factory(User::class, 2)->create();

        $response = $this->actingAs($user)->delete(route('admin.users.destroy', [
            'user' => $userToDelete->getKey()
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'email' => $userToDelete->email,
            'name' => $userToDelete->name,
        ]);
        $this->assertDatabaseMissing('users', [
           'email' => $userToDelete->email,
           'name' => $userToDelete->name,
        ]);
    }

    /** @test */
    public function it_cant_deletes_a_nonexistent_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->delete(route('admin.users.destroy', [
            'user' => 2,
        ]));

        $response->assertStatus(404);
    }
}
