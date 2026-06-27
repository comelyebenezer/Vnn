<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FactChecker extends Model
{
    protected $fillable = [
        'user_id',
        'specialization',
        'certification',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
