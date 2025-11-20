<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'ISBN',
        'edition',
        'publication_year',
        'total_copies',
        'available_copies',
        'manual_sync_flag',
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function waitlists(): HasMany
    {
        return $this->hasMany(Waitlist::class);
    }

    public function borrowedItems(): HasMany
    {
        return $this->hasMany(BorrowedItem::class);
    }

    // Helper methods
    public function isAvailable(): bool
    {
        return $this->available_copies > 0;
    }
}