<?php

namespace App\Http\Livewire\Admin\BreakingNews;

use App\Models\BreakingNews;
use Livewire\Component;
use Livewire\WithPagination;

class BreakingNewsList extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $sortField = 'priority';
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

    public function deleteBreaking($id)
    {
        BreakingNews::findOrFail($id)->delete();
        session()->flash('message', 'Breaking news deleted.');
    }

    public function render()
    {
        $query = BreakingNews::query()
            ->with('article:id,title')
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.breaking-news.index', [
            'breakingNews' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
