<?php

namespace App\Http\Livewire\Admin\Documentary;

use App\Http\Livewire\Admin\Articles\ArticleManager;
use App\Models\Category;

class DocumentaryManager extends ArticleManager
{
    public $youtube_url;

    public function mount($article = null)
    {
        parent::mount($article);

        $categoryId = Category::where('slug', 'documentary')->value('id');
        if ($categoryId) {
            $this->category_id = $categoryId;
        }

        if ($this->editMode && $article) {
            $this->youtube_url = is_string($article) || is_int($article)
                ? \App\Models\Article::findOrFail($article)->youtube_url
                : $article->youtube_url;
        }
    }

    protected function rules(): array
    {
        $rules = parent::rules();
        $rules['youtube_url'] = 'nullable|url';
        return $rules;
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->existing_image;

        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('articles', 'public');
        }

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'featured_image' => $imagePath,
            'image_caption' => $this->image_caption,
            'status' => $this->status,
            'is_featured' => $this->is_featured,
            'is_breaking' => $this->is_breaking,
            'is_trending' => $this->is_trending,
            'is_editor_pick' => $this->is_editor_pick,
            'allow_comments' => $this->allow_comments,
            'reading_time' => $this->calculateReadingTime($this->body),
            'scheduled_date' => $this->scheduled_date,
            'publication_date' => $this->status === 'published' ? now() : null,
            'youtube_url' => $this->youtube_url,
        ];

        if ($this->editMode) {
            $article = \App\Models\Article::findOrFail($this->articleId);
            $article->update($data);
            $article->tags()->sync($this->tags);
            session()->flash('message', 'Documentary updated successfully.');
        } else {
            $data['user_id'] = \Illuminate\Support\Facades\Auth::id();
            $article = \App\Models\Article::create($data);
            if (!empty($this->tags)) {
                $article->tags()->attach($this->tags);
            }
            $this->reset();
            session()->flash('message', 'Documentary created successfully.');
        }

        return redirect()->route('admin.documentary.index');
    }

    public function render()
    {
        return parent::render()->layout('layouts.app');
    }
}
