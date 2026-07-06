<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'url',
        'video_file',
        'embed_code',
        'thumbnail',
        'duration',
        'category_id',
        'user_id',
        'status',
        'views',
        'is_top',
    ];

    protected function casts(): array
    {
        return [
            'views' => 'integer',
            'is_top' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
