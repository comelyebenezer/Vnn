<?php

namespace App\Http\Livewire\Admin\Podcasts;

use App\Models\Podcast;
use Livewire\Component;
use Livewire\WithPagination;

class PodcastList extends Component
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

    public function deletePodcast($id)
    {
        Podcast::findOrFail($id)->delete();
        session()->flash('message', 'Podcast moved to trash.');
    }

    public function render()
    {
        $query = Podcast::query()
            ->with('category')
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.podcasts.index', [
            'podcasts' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
