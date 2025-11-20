<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'remember_token',
    ];
    

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationships
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
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
        return $this->hasMany(BorrowedItem::class, 'user_id');
    }

    public function processedBorrowedItems(): HasMany
    {
        return $this->hasMany(BorrowedItem::class, 'staff_pickup_id');
    }

    public function fines(): HasMany
    {
        return $this->hasMany(Fine::class);
    }

    public function messagingLogs(): HasMany
    {
        return $this->hasMany(MessagingLog::class);
    }
}
