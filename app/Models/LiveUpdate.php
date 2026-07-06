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

    public function getEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) return null;

        $url = $this->video_url;

        if ($this->video_type === 'youtube') {
            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/', $url, $m)) {
                return 'https://www.youtube.com/embed/' . $m[1];
            }
        }

        if ($this->video_type === 'facebook') {
            if (str_contains($url, 'facebook.com') && !str_contains($url, '/plugins/video.php')) {
                return 'https://www.facebook.com/plugins/video.php?href=' . urlencode($url);
            }
        }

        return $url;
    }
}
