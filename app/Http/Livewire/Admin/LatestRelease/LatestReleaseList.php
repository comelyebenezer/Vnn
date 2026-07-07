<?php

namespace App\Http\Livewire\Admin\LatestRelease;

use App\Models\Article;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class LatestReleaseList extends Component
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

    public function deleteArticle($id)
    {
        Article::findOrFail($id)->delete();
        session()->flash('message', 'Article moved to trash.');
    }

    public function render()
    {
        $categoryId = Category::where('slug', 'latest-release')->value('id');

        $query = Article::query()
            ->with(['author', 'category', 'tags'])
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('excerpt', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.latest-release.index', [
            'articles' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}
