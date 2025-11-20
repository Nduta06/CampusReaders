<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BorrowedItem extends Model
{
    use HasFactory;

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

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
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