<?php

namespace App\Http\Livewire\Admin\Live;

use App\Models\LiveUpdate;
use Livewire\Component;
use Livewire\WithPagination;

class LiveList extends Component
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

    public function toggleLive($id)
    {
        $live = LiveUpdate::findOrFail($id);
        $live->update(['is_live' => !$live->is_live]);
    }

    public function deleteLive($id)
    {
        LiveUpdate::findOrFail($id)->delete();
        session()->flash('message', 'Live update deleted.');
    }

    public function render()
    {
        $query = LiveUpdate::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.live.index', [
            'liveUpdates' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
