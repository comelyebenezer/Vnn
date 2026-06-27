<?php

namespace App\Http\Livewire\Admin\Advertisements;

use App\Models\Advertisement;
use Livewire\Component;
use Livewire\WithPagination;

class AdvertisementList extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = ['search', 'status'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function deleteAdvertisement($id)
    {
        Advertisement::findOrFail($id)->delete();
        session()->flash('message', 'Advertisement deleted.');
    }

    public function render()
    {
        $query = Advertisement::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('placement', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.advertisements.index', [
            'advertisements' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
