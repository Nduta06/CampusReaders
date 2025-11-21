<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class books extends Model
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
    public function categories(): BelongsTo
    {
        return $this->belongsTo(categories::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(reservations::class);
    }

    public function waitlists(): HasMany
    {
        return $this->hasMany(waitlists::class);
    }

    public function borrowed_Items(): HasMany
    {
        return $this->hasMany(borrowed_Items::class);
    }

    // Helper methods
    public function isAvailable(): bool
    {
        return $this->available_copies > 0;
    }
}