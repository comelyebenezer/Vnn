<?php

namespace App\Http\Livewire\Admin\Newsletter;

use App\Models\Newsletter;
use Livewire\Component;
use Livewire\WithPagination;

class NewsletterList extends Component
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

    public function deleteNewsletter($id)
    {
        Newsletter::findOrFail($id)->delete();
        session()->flash('message', 'Newsletter deleted.');
    }

    public function render()
    {
        $query = Newsletter::query()
            ->when($this->search, function ($q) {
                $q->where('subject', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.newsletter.index', [
            'newsletters' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
