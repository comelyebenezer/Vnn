<?php

namespace App\Http\Livewire\Admin\Articles;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleList extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $category_id = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

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

    public function deleteArticle($id)
    {
        Article::findOrFail($id)->delete();
        session()->flash('message', 'Article moved to trash.');
    }

    public function render()
    {
        $query = Article::query()
            ->with(['author', 'category', 'tags'])
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('excerpt', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))
            ->orderBy($this->sortField, $this->sortDirection);

        return view('admin.articles.index', [
            'articles' => $query->paginate(15),
            'categories' => \App\Models\Category::where('status', 'active')->get(),
        ])->layout('layouts.app');
    }
}
