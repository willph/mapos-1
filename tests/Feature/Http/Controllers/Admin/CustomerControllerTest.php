<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Events\CustomerCreatedEvent;
use App\Events\CustomerDeletedEvent;
use App\Events\CustomerUpdatedEvent;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\CustomerController
 */
class CustomerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $loggedUser = factory(User::class)->create();
        $customers = factory(Customer::class, 3)->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('admin.customers.index'));

        $response->assertOk();
        $response->assertViewIs('admin.customers.index');
        $response->assertViewHas('customers');
    }

    /**
     * @test
     */
    public function create_displays_view()
    {
        $loggedUser = factory(User::class)->create();
        $response = $this
            ->actingAs($loggedUser)
            ->get(route('admin.customers.create'));

        $response->assertOk();
        $response->assertViewIs('admin.customers.create');
        $response->assertViewHas('customer');
    }

    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\CustomerController::class,
            'store',
            \App\Http\Requests\Admin\CustomerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $loggedUser = factory(User::class)->create();
        $name = $this->faker->word;
        $document_number = $this->faker->word;
        $phone_number = $this->faker->phoneNumber;
        $mobile_phone_number = $this->faker->word;
        $email = $this->faker->safeEmail;
        $postal_code = $this->faker->postcode;
        $street_number = $this->faker->word;
        $street_name = $this->faker->word;
        $neighborhood = $this->faker->word;
        $city = $this->faker->city;
        $state = $this->faker->state;
        $complement = $this->faker->word;
        $contact = $this->faker->word;

        Event::fake();

        $response = $this
            ->actingAs($loggedUser)
            ->post(route('admin.customers.store'), [
                'name' => $name,
                'document_number' => $document_number,
                'phone_number' => $phone_number,
                'mobile_phone_number' => $mobile_phone_number,
                'email' => $email,
                'postal_code' => $postal_code,
                'street_number' => $street_number,
                'street_name' => $street_name,
                'neighborhood' => $neighborhood,
                'city' => $city,
                'state' => $state,
                'complement' => $complement,
                'contact' => $contact,
            ]);

        $customers = Customer::query()
            ->where('name', $name)
            ->where('document_number', $document_number)
            ->where('phone_number', $phone_number)
            ->where('mobile_phone_number', $mobile_phone_number)
            ->where('email', $email)
            ->where('postal_code', $postal_code)
            ->where('street_number', $street_number)
            ->where('street_name', $street_name)
            ->where('neighborhood', $neighborhood)
            ->where('city', $city)
            ->where('state', $state)
            ->where('complement', $complement)
            ->where('contact', $contact)
            ->get();
        $this->assertCount(1, $customers);
        $customer = $customers->first();

        $response->assertRedirect(route('admin.customers.index'));

        Event::assertDispatched(CustomerCreatedEvent::class, function ($event) use ($customer) {
            return $event->customer->is($customer);
        });
    }

    /**
     * @test
     */
    public function show_displays_view()
    {
        $loggedUser = factory(User::class)->create();
        $customer = factory(Customer::class)->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('admin.customers.show', $customer));

        $response->assertOk();
        $response->assertViewIs('admin.customers.show');
        $response->assertViewHas('customer');
    }

    /**
     * @test
     */
    public function edit_displays_view()
    {
        $loggedUser = factory(User::class)->create();
        $customer = factory(Customer::class)->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('admin.customers.edit', $customer));

        $response->assertOk();
        $response->assertViewIs('admin.customers.edit');
        $response->assertViewHas('customer');
    }

    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\CustomerController::class,
            'update',
            \App\Http\Requests\Admin\CustomerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_saves_and_redirects()
    {
        $loggedUser = factory(User::class)->create();
        $customer = factory(Customer::class)->create();
        $name = $this->faker->word;
        $document_number = $this->faker->word;
        $phone_number = $this->faker->phoneNumber;
        $mobile_phone_number = $this->faker->word;
        $email = $this->faker->safeEmail;
        $postal_code = $this->faker->postcode;
        $street_number = $this->faker->word;
        $street_name = $this->faker->word;
        $neighborhood = $this->faker->word;
        $city = $this->faker->city;
        $state = $this->faker->state;
        $complement = $this->faker->word;
        $contact = $this->faker->word;

        Event::fake();

        $response = $this
            ->actingAs($loggedUser)
            ->put(route('admin.customers.update', $customer), [
                'name' => $name,
                'document_number' => $document_number,
                'phone_number' => $phone_number,
                'mobile_phone_number' => $mobile_phone_number,
                'email' => $email,
                'postal_code' => $postal_code,
                'street_number' => $street_number,
                'street_name' => $street_name,
                'neighborhood' => $neighborhood,
                'city' => $city,
                'state' => $state,
                'complement' => $complement,
                'contact' => $contact,
            ]);

        $customers = Customer::query()
            ->where('name', $name)
            ->where('document_number', $document_number)
            ->where('phone_number', $phone_number)
            ->where('mobile_phone_number', $mobile_phone_number)
            ->where('email', $email)
            ->where('postal_code', $postal_code)
            ->where('street_number', $street_number)
            ->where('street_name', $street_name)
            ->where('neighborhood', $neighborhood)
            ->where('city', $city)
            ->where('state', $state)
            ->where('complement', $complement)
            ->where('contact', $contact)
            ->get();
        $this->assertCount(1, $customers);
        $customer = $customers->first();

        $response->assertRedirect(route('admin.customers.index'));

        Event::assertDispatched(CustomerUpdatedEvent::class, function ($event) use ($customer) {
            return $event->customer->is($customer);
        });
    }

    /**
     * @test
     */
    public function destroy_deletes()
    {
        $loggedUser = factory(User::class)->create();
        $customer = factory(Customer::class)->create();

        Event::fake();

        $response = $this
            ->actingAs($loggedUser)
            ->delete(route('admin.customers.destroy', $customer));

        $response->assertJson([
            'name' => $customer->name,
            'document_number' => $customer->document_number,
            'phone_number' => $customer->phone_number,
            'mobile_phone_number' => $customer->mobile_phone_number,
            'email' => $customer->email,
            'postal_code' => $customer->postal_code,
            'street_number' => $customer->street_number,
            'street_name' => $customer->street_name,
            'neighborhood' => $customer->neighborhood,
            'city' => $customer->city,
            'state' => $customer->state,
            'complement' => $customer->complement,
            'contact' => $customer->contact,
        ]);
        $response->assertOk();

        $this->assertDeleted($customer);

        Event::assertDispatched(CustomerDeletedEvent::class, function ($event) use ($customer) {
            return $event->customer->is($customer);
        });
    }
}
