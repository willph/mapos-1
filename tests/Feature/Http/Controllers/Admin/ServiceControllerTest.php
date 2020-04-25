<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\ServiceController
 */
class ServiceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $loggedUser = factory(User::class)->create();
        $services = factory(Service::class, 3)->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('admin.services.index'));

        $response->assertOk();
        $response->assertViewIs('admin.services.index');
        $response->assertViewHas('services');
    }

    /**
     * @test
     */
    public function create_displays_view()
    {
        $loggedUser = factory(User::class)->create();
        $response = $this
            ->actingAs($loggedUser)
            ->get(route('admin.services.create'));

        $response->assertOk();
        $response->assertViewIs('admin.services.create');
        $response->assertViewHas('service');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\ServiceController::class,
            'store',
            \App\Http\Requests\Admin\ServiceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $loggedUser = factory(User::class)->create();
        $name = $this->faker->word;
        $description = $this->faker->word;
        $price = $this->faker->numberBetween(0, 1000);

        $response = $this
            ->actingAs($loggedUser)
            ->post(route('admin.services.store'), [
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ]);

        $response->assertStatus(302);

        $services = Service::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('price', $price)
            ->get();
        $this->assertCount(1, $services);
        $service = $services->first();

        $response->assertRedirect(route('admin.services.index'));
    }

    /**
     * @test
     */
    public function show_displays_view()
    {
        $loggedUser = factory(User::class)->create();
        $service = factory(Service::class)->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('admin.services.show', $service));

        $response->assertOk();
        $response->assertViewIs('admin.services.show');
        $response->assertViewHas('service');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $loggedUser = factory(User::class)->create();
        $service = factory(Service::class)->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('admin.services.edit', $service));

        $response->assertOk();
        $response->assertViewIs('admin.services.edit');
        $response->assertViewHas('service');
    }

    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\ServiceController::class,
            'update',
            \App\Http\Requests\Admin\ServiceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_saves_and_redirects()
    {
        $loggedUser = factory(User::class)->create();
        $service = factory(Service::class)->create();
        $name = $this->faker->word;
        $description = $this->faker->word;
        $price = $this->faker->numberBetween(0, 1000);

        $response = $this
            ->actingAs($loggedUser)
            ->put(route('admin.services.update', $service), [
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ]);

        $response->assertStatus(302);

        $services = Service::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('price', $price)
            ->get();
        $this->assertCount(1, $services);
        $service = $services->first();

        $response->assertRedirect(route('admin.services.index'));
    }

    /**
     * @test
     */
    public function destroy_deletes()
    {
        $loggedUser = factory(User::class)->create();
        $service = factory(Service::class)->create();

        $response = $this
            ->actingAs($loggedUser)
            ->delete(route('admin.services.destroy', $service));

        $response->assertJson([
            'name' => $service->name,
            'description' => $service->description,
            'price' => $service->price,
        ]);
        $response->assertOk();

        $this->assertDeleted($service);
    }
}
