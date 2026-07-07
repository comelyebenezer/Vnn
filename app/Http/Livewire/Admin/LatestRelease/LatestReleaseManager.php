<?php

namespace App\Http\Livewire\Admin\LatestRelease;

use App\Http\Livewire\Admin\Articles\ArticleManager;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class LatestReleaseManager extends ArticleManager
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

        $categoryId = \App\Models\Category::where('slug', 'latest-release')->value('id');
        if ($categoryId) {
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
        $rules['youtube_url'] = 'nullable|url';
        $rules['media_file'] = 'nullable|file|mimes:mp4,mpeg,ogg,webm,quicktime|max:102400';
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
            $mediaType = 'video';
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
            session()->flash('message', 'Latest Release updated successfully.');
        } else {
            $data['user_id'] = \Illuminate\Support\Facades\Auth::id();
            $article = \App\Models\Article::create($data);
            if (!empty($this->tags)) {
                $article->tags()->attach($this->tags);
            }
            $this->reset();
            session()->flash('message', 'Latest Release created successfully.');
        }

        return redirect()->route('admin.latest-release.index');
    }

    public function render()
    {
        return parent::render()->layout('layouts.app');
    }
}
