<?php

namespace App\Http\Livewire\Admin\Subcategories;

use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class SubcategoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $category_id = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    protected $queryString = ['search', 'status', 'category_id'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function deleteSubcategory($id)
    {
        Subcategory::findOrFail($id)->delete();
        session()->flash('message', 'Subcategory deleted.');
    }

    public function render()
    {
        $query = Subcategory::query()
            ->with('categories')
            ->withCount('articles')
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->when($this->category_id, fn($q) => $q->whereHas('categories', fn($cq) => $cq->where('categories.id', $this->category_id)))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.subcategories.index', [
            'subcategories' => $query->paginate(15),
            'categories' => \App\Models\Category::where('status', 'active')->orderBy('name')->get(),
        ])->layout('layouts.app');
    }
}
