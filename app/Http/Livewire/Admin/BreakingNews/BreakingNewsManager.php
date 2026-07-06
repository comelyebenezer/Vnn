<?php

namespace App\Http\Livewire\Admin\BreakingNews;

use App\Models\Article;
use App\Models\BreakingNews;
use Livewire\Component;

class BreakingNewsManager extends Component
{
    public $breakingId;
    public $title;
    public $content;
    public $article_id;
    public $status = 'active';
    public $priority = 3;
    public $expires_at;

    public $editMode = false;

    protected function rules()
    {
        return [
            'title' => 'required|min:2|max:255',
            'content' => 'nullable|max:1000',
            'article_id' => 'nullable|exists:articles,id',
            'status' => 'required|in:active,inactive',
            'priority' => 'required|integer|min:1|max:10',
            'expires_at' => 'nullable|date',
        ];
    }

    public function mount($breakingnews = null)
    {
        if ($breakingnews) {
            if (is_string($breakingnews) || is_int($breakingnews)) {
                $breakingnews = \App\Models\BreakingNews::findOrFail($breakingnews);
            }

            $this->editMode = true;
            $this->breakingId = $breakingnews->id;
            $this->title = $breakingnews->title;
            $this->content = $breakingnews->content;
            $this->article_id = $breakingnews->article_id;
            $this->status = $breakingnews->status;
            $this->priority = $breakingnews->priority;
            $this->expires_at = $breakingnews->expires_at?->format('Y-m-d\TH:i');
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'content' => $this->content,
            'article_id' => $this->article_id ?: null,
            'status' => $this->status,
            'priority' => $this->priority,
            'expires_at' => $this->expires_at ?: null,
        ];

        if ($this->editMode) {
            BreakingNews::findOrFail($this->breakingId)->update($data);
            session()->flash('message', 'Breaking news updated successfully.');
        } else {
            BreakingNews::create($data);
            $this->reset();
            session()->flash('message', 'Breaking news created successfully.');
        }

        return redirect()->route('admin.breaking-news.index');
    }

    public function render()
    {
        return view('admin.breaking-news.form', [
            'articles' => Article::published()->orderBy('title')->get(['id', 'title']),
        ])->layout('layouts.app');
    }
}
