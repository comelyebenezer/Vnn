<?php

namespace App\Http\Livewire\Admin\Articles;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ArticleManager extends Component
{
    use WithFileUploads;

    public $articleId;
    public $title;
    public $slug;
    public $category_id;
    public $subcategory_id;
    public $excerpt;
    public $body;
    public $featured_image;
    public $existing_image;
    public $image_caption;
    public $status = 'draft';
    public $is_featured = false;
    public $is_breaking = false;
    public $is_trending = false;
    public $is_editor_pick = false;
    public $allow_comments = true;
    public $tags = [];
    public $scheduled_date;
    public $reading_time;
    public $editor_id;

    public $type = 'article';
    public $youtube_url;
    public $media_file;
    public $media_type;
    public $existing_media;
    public $remove_media = false;

    public $editMode = false;

    protected function rules()
    {
        $rules = [
            'title' => 'required|min:5|max:255',
            'slug' => 'required|unique:articles,slug,' . $this->articleId,
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'excerpt' => 'nullable|max:500',
            'body' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'image_caption' => 'nullable|max:255',
            'status' => 'required|in:draft,pending_review,fact_checking,approved,scheduled,published,rejected',
            'is_featured' => 'boolean',
            'is_breaking' => 'boolean',
            'is_trending' => 'boolean',
            'is_editor_pick' => 'boolean',
            'allow_comments' => 'boolean',
            'scheduled_date' => 'nullable|date_format:Y-m-d\TH:i',
            'type' => 'required|in:article,video,podcast',
            'youtube_url' => 'nullable|url',
            'media_file' => 'nullable|file|mimes:mp4,mpeg,ogg,webm,quicktime|max:102400',
            'editor_id' => 'nullable|exists:users,id',
        ];

        if ($this->status === 'scheduled') {
            $rules['scheduled_date'] = 'required|date_format:Y-m-d\TH:i|after:now';
        }

        return $rules;
    }

    public function mount($article = null)
    {
        if ($article) {
            if (is_string($article) || is_int($article)) {
                $article = Article::findOrFail($article);
            }

            $this->editMode = true;
            $this->articleId = $article->id;
            $this->title = $article->title;
            $this->slug = $article->slug;
            $this->category_id = $article->category_id;
            $this->subcategory_id = $article->subcategory_id;
            $this->excerpt = $article->excerpt;
            $this->body = $article->body;
            $this->existing_image = $article->featured_image;
            $this->image_caption = $article->image_caption;
            $this->status = $article->status;
            $this->is_featured = $article->is_featured;
            $this->is_breaking = $article->is_breaking;
            $this->is_trending = $article->is_trending;
            $this->is_editor_pick = $article->is_editor_pick;
            $this->allow_comments = $article->allow_comments;
            $this->scheduled_date = $article->scheduled_date?->format('Y-m-d\TH:i');
            $this->reading_time = $article->reading_time;
            $this->tags = $article->tags->pluck('id')->toArray();
            $this->type = $article->type ?? 'article';
            $this->youtube_url = $article->youtube_url;
            $this->existing_media = $article->media_file;
            $this->media_type = $article->media_type;
            $this->editor_id = $article->editor_id;
        }
    }

    public function updatedTitle($value)
    {
        if (!$this->editMode) {
            $this->slug = Str::slug($value);
        }
    }

    public function updatedCategoryId($value)
    {
        $this->subcategory_id = null;
    }

    public function updatedBody($value)
    {
        if (!$this->editMode && empty($this->excerpt)) {
            $this->excerpt = Str::limit(strip_tags($value), 150);
        }
    }

    public function updatedFeaturedImage()
    {
        if ($this->featured_image) {
            $this->dispatch('image-uploaded', fileName: $this->featured_image->getClientOriginalName());
        }
    }

    public function removeExistingMedia()
    {
        $this->remove_media = true;
        $this->existing_media = null;
    }

    public function save()
    {
        $this->validate();

        if (empty($this->slug)) {
            $this->slug = Str::slug($this->title);
        }

        if (empty($this->excerpt)) {
            $this->excerpt = Str::limit(strip_tags($this->body), 150);
        }

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
            $mediaType = str_starts_with($this->media_file->getMimeType(), 'video/') ? 'video' : 'video';
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
            'type' => $this->type,
            'youtube_url' => $this->type === 'video' ? $this->youtube_url : null,
            'media_file' => $this->type === 'video' ? $mediaPath : null,
            'media_type' => $this->type === 'video' ? $mediaType : null,
            'editor_id' => $this->editor_id,
        ];

        if ($this->editMode) {
            $article = Article::findOrFail($this->articleId);
            $article->update($data);
            $article->tags()->sync($this->tags);
            session()->flash('message', 'Article updated successfully.');
        } else {
            $data['user_id'] = Auth::id();
            $article = Article::create($data);
            if (!empty($this->tags)) {
                $article->tags()->attach($this->tags);
            }
            $this->reset();
            session()->flash('message', 'Article created successfully.');
        }

        return redirect()->route('admin.articles.index');
    }

    public function updatedStatus($value)
    {
        if (in_array($value, ['pending_review', 'fact_checking', 'approved', 'published', 'rejected'])) {
            $this->dispatch('workflow-updated', status: $value);
        }
    }

    public function calculateReadingTime($content): int
    {
        $words = str_word_count(strip_tags($content ?? ''));
        return max(1, ceil($words / 200));
    }

    public function render()
    {
        return view('admin.articles.form', [
            'categories' => Category::where('status', 'active')->orderBy('name')->get(),
            'allTags' => Tag::orderBy('name')->get(),
            'editors' => \App\Models\User::orderBy('name')->get(),
            'subcategories' => $this->category_id
                ? \App\Models\Subcategory::where('category_id', $this->category_id)->where('status', 'active')->get()
                : collect(),
        ])->layout('layouts.app');
    }
}
