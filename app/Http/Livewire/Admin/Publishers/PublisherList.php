<?php

namespace App\Http\Livewire\Admin\Publishers;

use App\Models\Publisher;
use Livewire\Component;
use Livewire\WithPagination;

class PublisherList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = ['search'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function deletePublisher($id)
    {
        Publisher::findOrFail($id)->delete();
        session()->flash('message', 'Publisher deleted.');
    }

    public function render()
    {
        $query = Publisher::query()
            ->with('user')
            ->when($this->search, function ($q) {
                $q->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.publishers.index', [
            'publishers' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
