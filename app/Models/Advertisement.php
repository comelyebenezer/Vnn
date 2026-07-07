<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'title',
        'type',
        'placement',
        'image_url',
        'media_file',
        'media_type',
        'script_code',
        'link',
        'start_date',
        'end_date',
        'status',
        'impressions',
        'clicks',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'impressions' => 'integer',
            'clicks' => 'integer',
        ];
    }
}
