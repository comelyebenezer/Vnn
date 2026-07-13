<?php

namespace App\Http\Livewire\Admin\Documentary;

use App\Http\Livewire\Admin\Articles\ArticleManager;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class DocumentaryManager extends ArticleManager
{
    use WithFileUploads;

    public $youtube_url;
    public $media_file;
    public $media_type;
    public $existing_media;
    public $remove_media = false;

    public function mount($article = null)
    {
        parent::mount($article);

        $categoryId = Category::where('slug', 'documentary')->value('id');
        if ($categoryId) {
            if (!$this->editMode || empty($this->selected_categories)) {
                $this->selected_categories = [$categoryId];
            }
            $this->category_id = $categoryId;
        }

        if ($this->editMode && $article) {
            $article = is_string($article) || is_int($article)
                ? \App\Models\Article::findOrFail($article)
                : $article;
            $this->youtube_url = $article->youtube_url;
            $this->existing_media = $article->media_file;
            $this->media_type = $article->media_type;
        }
    }

    protected function rules(): array
    {
        $rules = parent::rules();
        $rules['youtube_url'] = 'required|string';
        return $rules;
    }

    public function removeExistingMedia()
    {
        $this->remove_media = true;
        $this->existing_media = null;
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->existing_image;
        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('articles', 'public');
        }

        $mediaPath = $this->existing_media;
        $mediaType = $this->media_type;

        if ($this->remove_media && $this->existing_media) {
            Storage::disk('public')->delete($this->existing_media);
            $mediaPath = null;
            $mediaType = null;
        } elseif ($this->media_file && !$this->remove_media) {
            $mediaPath = $this->media_file->store('articles/media', 'public');
            $mediaType = $this->media_file->getMimeType() === 'video/mp4' ? 'video' : 'video';
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
            'media_file' => $mediaPath,
            'media_type' => $mediaType,
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
        $allCategories = \App\Models\Category::where('status', 'active')->orderBy('name')->get();

        $availableSubcategories = \App\Models\Subcategory::whereHas('categories', function ($q) {
            $q->whereIn('categories.id', $this->selected_categories);
        })->where('status', 'active')->orderBy('name')->get();

        return view('admin.documentary.form', [
            'categories' => $allCategories,
            'allTags' => \App\Models\Tag::orderBy('name')->get(),
            'editors' => \App\Models\User::orderBy('name')->get(),
            'subcategories' => $availableSubcategories,
        ])->layout('layouts.app');
    }
}
