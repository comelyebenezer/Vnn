<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BreakingNews extends Model
{
    protected $fillable = [
        'title',
        'content',
        'article_id',
        'status',
        'priority',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'priority' => 'integer',
            'expires_at' => 'datetime',
        ];
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
