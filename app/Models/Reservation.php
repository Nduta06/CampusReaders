<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'reserved_at',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'reserved_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // Relationships
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function books(): BelongsTo
    {
        return $this->belongsTo(books::class);
    }

    // Helper method
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}