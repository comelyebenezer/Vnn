<?php

namespace App\Http\Livewire\Admin\Gallery;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryList extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $sortField = 'sort_order';
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

    public function deleteGallery($id)
    {
        Gallery::findOrFail($id)->delete();
        session()->flash('message', 'Gallery image deleted.');
    }

    public function render()
    {
        $query = Gallery::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('caption', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.gallery.index', [
            'galleries' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
