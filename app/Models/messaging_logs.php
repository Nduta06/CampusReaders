<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessagingLog extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'recipient',
        'content',
        'sent_at',
        'status',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}