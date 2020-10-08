<?php

namespace Tests\Feature\Http\Livewire\Customers;

use App\Http\Livewire\Customers\Index;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use JMac\Testing\Traits\AdditionalAssertions;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @see \App\Http\Livewire\Customers\Index
 */
class IndexTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function it_can_see_initial_data()
    {
        $loggedUser = factory(User::class)->create();
        $customers = factory(Customer::class, 10)->create();

        $this->actingAs($loggedUser);

        Livewire::test(Index::class)
            ->assertViewHas('customers', function (LengthAwarePaginator $paginator) use ($customers) {
                return empty($customers->diff($paginator->items())->toArray());
            });
    }

    /**
     * @test
     */
    public function it_can_search_customers_by_name()
    {
        $loggedUser = factory(User::class)->create();
        [$customerToSearch] = factory(Customer::class, 10)->create();

        $this->actingAs($loggedUser);

        Livewire::test(Index::class)
            ->set('search', $customerToSearch->name)
            ->assertViewHas('customers', function (LengthAwarePaginator $paginator) use ($customerToSearch) {
                $searchResults = collect($paginator->items());

                return count($searchResults) === 1 && $searchResults->first()->is($customerToSearch);
            });
    }

    /**
     * @test
     */
    public function destroy_deletes()
    {
        $loggedUser = factory(User::class)->create();
        $customer = factory(Customer::class)->create();

        $this->actingAs($loggedUser);

        Livewire::test(Index::class)
            ->call('destroy', $customer->getKey());

        $this->assertDatabaseMissing('customers', $customer->toArray());
    }
}
