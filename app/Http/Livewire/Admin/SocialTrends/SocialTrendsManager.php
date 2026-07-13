<?php

namespace App\Http\Livewire\Admin\SocialTrends;

use App\Http\Livewire\Admin\Articles\ArticleManager;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class SocialTrendsManager extends ArticleManager
{
    use WithFileUploads;

    public $social_platform = 'youtube';
    public $media_content_type = 'video';
    public $video_url;
    public $media_file;
    public $image_file;
    public $existing_media;
    public $existing_image_file;
    public $remove_media = false;

    public function mount($article = null)
    {
        parent::mount($article);

        $categoryId = \App\Models\Category::where('slug', 'social-trends')->value('id');
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
            $this->social_platform = $article->social_platform ?? 'youtube';
            $this->media_content_type = $article->media_content_type ?? 'video';
            $this->video_url = $article->youtube_url;
            $this->existing_media = $article->media_file;
            $this->existing_image_file = $article->image_file ?? null;
        }
    }

    protected function rules(): array
    {
        $rules = parent::rules();
        $rules['social_platform'] = 'required|in:youtube,tiktok,instagram,facebook,twitter,other';
        $rules['media_content_type'] = 'required|in:video,image';

        if ($this->media_content_type === 'video') {
            if (empty($this->existing_media)) {
                $rules['video_url'] = 'required_without:media_file|nullable|url';
            } else {
                $rules['video_url'] = 'nullable|url';
            }
            $rules['media_file'] = 'nullable|file|mimes:mp4,mpeg,ogg,webm,quicktime|max:102400';
        } else {
            if (empty($this->existing_image_file)) {
                $rules['image_file'] = 'required|image|max:10240';
            } else {
                $rules['image_file'] = 'nullable|image|max:10240';
            }
        }

        return $rules;
    }

    public function updatedMediaContentType($value)
    {
        $this->video_url = null;
        $this->media_file = null;
        $this->image_file = null;
    }

    public function removeExistingMedia()
    {
        $this->remove_media = true;
        $this->existing_media = null;
    }

    public function removeExistingImageFile()
    {
        $this->existing_image_file = null;
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->existing_image;
        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('articles', 'public');
        }

        $mediaPath = $this->existing_media;
        $mediaType = null;

        if ($this->media_content_type === 'video') {
            if ($this->remove_media && $this->existing_media) {
                Storage::disk('public')->delete($this->existing_media);
                $mediaPath = null;
            } elseif ($this->media_file && !$this->remove_media) {
                $mediaPath = $this->media_file->store('articles/media', 'public');
                $mediaType = 'video';
            }
        } else {
            if ($this->remove_media && $this->existing_media) {
                Storage::disk('public')->delete($this->existing_media);
                $mediaPath = null;
            }
        }

        $imageFilePath = $this->existing_image_file;
        if ($this->media_content_type === 'image' && $this->image_file) {
            if ($this->existing_image_file) {
                Storage::disk('public')->delete($this->existing_image_file);
            }
            $imageFilePath = $this->image_file->store('social-trends/images', 'public');
        } elseif ($this->media_content_type === 'video') {
            if ($this->existing_image_file) {
                Storage::disk('public')->delete($this->existing_image_file);
            }
            $imageFilePath = null;
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
            'youtube_url' => $this->media_content_type === 'video' ? $this->video_url : null,
            'media_file' => $mediaPath,
            'media_type' => $mediaType,
            'social_platform' => $this->social_platform,
            'media_content_type' => $this->media_content_type,
            'image_file' => $imageFilePath,
            'type' => 'video',
        ];

        if ($this->editMode) {
            $article = \App\Models\Article::findOrFail($this->articleId);
            $article->update($data);
            $article->tags()->sync($this->tags);
            session()->flash('message', 'Social trend updated successfully.');
        } else {
            $data['user_id'] = \Illuminate\Support\Facades\Auth::id();
            $article = \App\Models\Article::create($data);
            if (!empty($this->tags)) {
                $article->tags()->attach($this->tags);
            }
            $this->reset();
            session()->flash('message', 'Social trend created successfully.');
        }

        return redirect()->route('admin.social-trends.index');
    }

    public function render()
    {
        $allCategories = \App\Models\Category::where('status', 'active')->orderBy('name')->get();

        $availableSubcategories = \App\Models\Subcategory::whereHas('categories', function ($q) {
            $q->whereIn('categories.id', $this->selected_categories);
        })->where('status', 'active')->orderBy('name')->get();

        return view('admin.social-trends.form', [
            'categories' => $allCategories,
            'allTags' => \App\Models\Tag::orderBy('name')->get(),
            'editors' => \App\Models\User::orderBy('name')->get(),
            'subcategories' => $availableSubcategories,
        ])->layout('layouts.app');
    }
}
