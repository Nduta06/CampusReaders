<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function roles(): BelongsTo
    {
        return $this->belongsTo(roles::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(reservations::class);
    }

    public function waitlists(): HasMany
    {
        return $this->hasMany(waitlists::class);
    }

    public function borrowed_items(): HasMany
    {
        return $this->hasMany(borrowed_items::class, 'user_id');
    }


    public function fines(): HasMany
    {
        return $this->hasMany(fines::class);
    }

    public function messaging_logs(): HasMany
    {
        return $this->hasMany(messaging_logs::class);
    }

    // Authorization helper methods
    public function isAdmin(): bool
    {
        return $this->role->name === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role->name === 'staff';
    }

    public function isGuest(): bool
    {
        return $this->role->name === 'guest';
    }

    public function hasRole(string $role): bool
    {
        return $this->role->name === $role;
    }
}