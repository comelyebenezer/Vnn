<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = [
        'subject',
        'content',
        'status',
        'sent_at',
        'total_recipients',
        'opened_count',
        'clicked_count',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'total_recipients' => 'integer',
            'opened_count' => 'integer',
            'clicked_count' => 'integer',
        ];
    }
}
