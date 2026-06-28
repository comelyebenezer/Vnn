<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveUpdate extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video_url',
        'video_type',
        'video_file',
        'is_live',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_live' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeLive($query)
    {
        return $query->where('is_live', true)->where('status', 'active');
    }
}
