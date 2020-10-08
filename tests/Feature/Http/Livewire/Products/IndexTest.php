<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Http\Livewire\Products\Index;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use JMac\Testing\Traits\AdditionalAssertions;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @see \App\Http\Livewire\Products\Index
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
        $products = factory(Product::class, 10)->create();

        $this->actingAs($loggedUser);

        Livewire::test(Index::class)
            ->assertViewHas('products', function (LengthAwarePaginator $paginator) use ($products) {
                return empty($products->diff($paginator->items())->toArray());
            });
    }

    /**
     * @test
     */
    public function it_can_search_products_by_name()
    {
        $loggedUser = factory(User::class)->create();
        [$productToSearch] = factory(Product::class, 10)->create();

        $this->actingAs($loggedUser);

        Livewire::test(Index::class)
            ->set('search', $productToSearch->name)
            ->assertViewHas('products', function (LengthAwarePaginator $paginator) use ($productToSearch) {
                $searchResults = collect($paginator->items());

                return count($searchResults) === 1 && $searchResults->first()->is($productToSearch);
            });
    }

    /**
     * @test
     */
    public function destroy_deletes()
    {
        $loggedUser = factory(User::class)->create();
        $product = factory(Product::class)->create();

        $this->actingAs($loggedUser);

        Livewire::test(Index::class)
            ->call('destroy', $product->getKey());

        $this->assertDatabaseMissing('products', $product->toArray());
    }
}
