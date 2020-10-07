<?php

namespace App\Http\Livewire\Services;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service;

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
            'services' => Service::where('name', 'like', $this->search . '%')->paginate(10),
        ]);
    }

    public function destroy($id)
    {
        if ($id) {
            $customer = Service::where('id', $id);
            $customer->delete();

            session()->flash('alert-success', __('messages.deleted_success'));
        }
    }
}
