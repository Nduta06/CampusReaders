<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BorrowedItem extends Model
{
    use HasFactory;

    protected $table = 'borrowed_items'; // Good practice to be explicit

    protected $fillable = [
        'user_id',
        'book_id',
        'staff_pickup_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    // --- Relationships ---

    // 1. Rename 'User' to 'user' (lowercase is standard)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 2. THIS IS THE FIX: Rename 'books' to 'book' (Singular)
    public function book(): BelongsTo
    {
        return $this->belongsTo(Books::class, 'book_id');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_pickup_id');
    }

    public function fine(): HasOne
    {
        return $this->hasOne(Fine::class);
    }
}