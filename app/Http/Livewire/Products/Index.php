<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.products.index', [
            'products' => Product::where('name', 'like', $this->search.'%')->paginate(10),
        ]);
    }

    public function destroy($id)
    {
        if (! $id) {
            return;
        }

        Product::query()->where('id', $id)->delete();
        session()->flash('alert-success', __('messages.deleted_success'));
    }
}
