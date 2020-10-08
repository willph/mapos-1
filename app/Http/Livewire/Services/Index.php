<?php

namespace App\Http\Livewire\Services;

use App\Models\Service;
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
        return view('livewire.services.index', [
            'services' => Service::where('name', 'like', $this->search.'%')->paginate(10),
        ]);
    }

    public function destroy($id)
    {
        if (! $id) {
            return;
        }

        Service::query()->where('id', $id)->delete();
        session()->flash('alert-success', __('messages.deleted_success'));
    }
}
