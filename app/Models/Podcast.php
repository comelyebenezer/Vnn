<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Podcast extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'audio_url',
        'cover_image',
        'duration',
        'episode_number',
        'season_number',
        'category_id',
        'user_id',
        'status',
        'plays',
    ];

    protected function casts(): array
    {
        return [
            'episode_number' => 'integer',
            'season_number' => 'integer',
            'plays' => 'integer',
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
