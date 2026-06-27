<?php

namespace App\Http\Livewire\Admin\Subscribers;

use App\Models\Subscriber;
use Livewire\Component;
use Livewire\WithPagination;

class SubscriberList extends Component
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

    public function deleteSubscriber($id)
    {
        Subscriber::findOrFail($id)->delete();
        session()->flash('message', 'Subscriber deleted.');
    }

    public function render()
    {
        $query = Subscriber::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('email', 'like', '%' . $this->search . '%')
                      ->orWhere('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.subscribers.index', [
            'subscribers' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
