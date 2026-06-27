<?php

namespace App\Http\Livewire\Admin\Authors;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;

class AuthorList extends Component
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

    public function deleteAuthor($id)
    {
        Author::findOrFail($id)->delete();
        session()->flash('message', 'Author deleted.');
    }

    public function render()
    {
        $query = Author::query()
            ->with('user')
            ->when($this->search, function ($q) {
                $q->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhere('expertise', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.authors.index', [
            'authors' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
