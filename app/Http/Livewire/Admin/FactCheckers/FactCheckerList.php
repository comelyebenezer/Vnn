<?php

namespace App\Http\Livewire\Admin\FactCheckers;

use App\Models\FactChecker;
use Livewire\Component;
use Livewire\WithPagination;

class FactCheckerList extends Component
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

    public function deleteFactChecker($id)
    {
        FactChecker::findOrFail($id)->delete();
        session()->flash('message', 'Fact checker deleted.');
    }

    public function render()
    {
        $query = FactChecker::query()
            ->with('user')
            ->when($this->search, function ($q) {
                $q->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhere('specialization', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.fact-checkers.index', [
            'factCheckers' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
