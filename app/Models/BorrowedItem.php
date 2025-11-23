<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Fine;
use App\Models\User;
use App\Models\Books;

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
    // File renamed to BorrowedItem.php. Please update class name to BorrowedItem.

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    // Relationships
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function books(): BelongsTo
    {
        return $this->belongsTo(Books::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_pickup_id');
    }

    public function fine(): HasOne
    {
        return $this->hasOne(fines::class);
    }
}