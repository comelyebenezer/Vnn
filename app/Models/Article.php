<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes, HasSeo;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'image_caption',
        'status',
        'publication_date',
        'scheduled_date',
        'is_featured',
        'is_breaking',
        'is_trending',
        'is_editor_pick',
        'is_tech_startup',
        'is_latest_gadget',
        'allow_comments',
        'view_count',
        'reading_time',
        'editor_id',
        'publisher_id',
        'fact_checker_id',
        'type',
        'youtube_url',
        'media_file',
        'media_type',
        'social_platform',
        'media_content_type',
        'image_file',
    ];

    protected function casts(): array
    {
        return [
            'publication_date' => 'datetime',
            'scheduled_date' => 'datetime',
            'is_featured' => 'boolean',
            'is_breaking' => 'boolean',
            'is_trending' => 'boolean',
            'is_editor_pick' => 'boolean',
            'is_tech_startup' => 'boolean',
            'is_latest_gadget' => 'boolean',
            'allow_comments' => 'boolean',
            'view_count' => 'integer',
            'reading_time' => 'integer',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function subcategories(): BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class)->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }

    public function factChecker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fact_checker_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(ArticleView::class);
    }

    public function breakingNews(): HasMany
    {
        return $this->hasMany(BreakingNews::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBreaking($query)
    {
        return $query->where('is_breaking', true);
    }

    public function scopeTrending($query)
    {
        return $query->where('is_trending', true);
    }

    public function scopeEditorPick($query)
    {
        return $query->where('is_editor_pick', true);
    }

    public function scopeTechStartup($query)
    {
        return $query->where('is_tech_startup', true);
    }

    public function scopeLatestGadget($query)
    {
        return $query->where('is_latest_gadget', true);
    }

    public function getYoutubeIdAttribute(): ?string
    {
        if (!$this->youtube_url) return null;

        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $this->youtube_url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }
}
