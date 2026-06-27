<?php

namespace App\Http\Livewire\Admin\Comments;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentList extends Component
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

    public function approveComment($id)
    {
        Comment::findOrFail($id)->update(['status' => 'approved']);
        session()->flash('message', 'Comment approved.');
    }

    public function rejectComment($id)
    {
        Comment::findOrFail($id)->update(['status' => 'rejected']);
        session()->flash('message', 'Comment rejected.');
    }

    public function deleteComment($id)
    {
        Comment::findOrFail($id)->delete();
        session()->flash('message', 'Comment deleted.');
    }

    public function render()
    {
        $query = Comment::query()
            ->with(['article:id,title,slug', 'user:id,name,email'])
            ->when($this->search, function ($q) {
                $q->where('body', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.comments.index', [
            'comments' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
