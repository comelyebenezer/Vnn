<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'email',
        'name',
        'is_verified',
        'verified_at',
        'unsubscribe_token',
        'preferences',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
            'preferences' => 'json',
        ];
    }
}
