<?php

namespace Tests\Feature\Http\Livewire\Services;

use App\Http\Livewire\Services\Index;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use JMac\Testing\Traits\AdditionalAssertions;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @see \App\Http\Livewire\Services\Index
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
        $services = factory(Service::class, 10)->create();

        $this->actingAs($loggedUser);

        Livewire::test(Index::class)
            ->assertViewHas('services', function (LengthAwarePaginator $paginator) use ($services) {
                return empty($services->diff($paginator->items())->toArray());
            });
    }

    /**
     * @test
     */
    public function it_can_search_services_by_name()
    {
        $loggedUser = factory(User::class)->create();
        [$serviceToSearch] = factory(Service::class, 10)->create();

        $this->actingAs($loggedUser);

        Livewire::test(Index::class)
            ->set('search', $serviceToSearch->name)
            ->assertViewHas('services', function (LengthAwarePaginator $paginator) use ($serviceToSearch) {
                $searchResults = collect($paginator->items());

                return count($searchResults) === 1 && $searchResults->first()->is($serviceToSearch);
            });
    }

    /**
     * @test
     */
    public function destroy_deletes()
    {
        $loggedUser = factory(User::class)->create();
        $service = factory(Service::class)->create();

        $this->actingAs($loggedUser);

        Livewire::test(Index::class)
            ->call('destroy', $service->getKey());

        $this->assertDatabaseMissing('services', $service->toArray());
    }
}
