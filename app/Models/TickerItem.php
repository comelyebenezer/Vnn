<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TickerItem extends Model
{
    protected $fillable = [
        'text',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
