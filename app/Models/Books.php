<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories\BooksFactory; 
use App\Models\Reservation;
 // <--- 1. Import the Factory

class Books extends Model
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

    
    protected static function newFactory()
    {
        return BooksFactory::new();
    }
    // ------------------------------------------------------------------

    // ------------------------------------------------------------------

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

    public function borrowed_Items(): HasMany
    {
        return $this->hasMany(BorrowedItem::class);
    }

    // Helper methods
    public function isAvailable(): bool
    {
        return $this->available_copies > 0;
    }
}