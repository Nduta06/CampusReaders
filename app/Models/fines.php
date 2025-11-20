<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowed_item_id',
        'user_id',
        'amount_due',
        'amount_paid',
        'incurred_on',
        'status',
    ];

    protected $casts = [
        'amount_due' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'incurred_on' => 'date',
    ];

    // Relationships
    public function borrowedItem(): BelongsTo
    {
        return $this->belongsTo(BorrowedItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Helper method
    public function outstandingBalance(): float
    {
        return $this->amount_due - $this->amount_paid;
    }
}