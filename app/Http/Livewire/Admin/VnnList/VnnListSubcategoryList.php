<?php

namespace App\Http\Livewire\Admin\VnnList;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class VnnListSubcategoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

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

    public function deleteSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $vnnListId = Category::where('slug', 'vnn-list')->value('id');
        $subcategory->categories()->detach($vnnListId);

        if ($subcategory->categories()->count() === 0) {
            $subcategory->delete();
        }

        session()->flash('message', 'Subcategory removed from VNN List.');
    }

    public function render()
    {
        $vnnListId = Category::where('slug', 'vnn-list')->value('id');

        $query = Subcategory::query()
            ->withCount('articles')
            ->whereHas('categories', fn($q) => $q->where('categories.id', $vnnListId))
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection);

        $total = (clone $query)->count();
        $active = (clone $query)->where('status', 'active')->count();
        $inactive = (clone $query)->where('status', 'inactive')->count();

        return view('admin.vnn-list.subcategories', [
            'subcategories' => $query->paginate(15),
            'total' => $total,
            'active' => $active,
            'inactive' => $inactive,
        ])->layout('layouts.app');
    }
}
