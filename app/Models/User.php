<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <--- Import this
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\MessagingLog;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roleId',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship to the Roles model
     */
    public function role(): BelongsTo
    {
        // We specify 'roleId' because the DB column is camelCase
        return $this->belongsTo(Role::class, 'roleId');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function waitlists()
    {
        return $this->hasMany(Waitlist::class);
    }

    public function borrowed_items()
    {
        return $this->hasMany(BorrowedItem::class, 'user_id');
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function messaging_logs()
    {
        return $this->hasMany(MessagingLog::class);
    }

    // Authorization helper methods
    public function isAdmin(): bool
    {
        return $this->role && $this->role->name === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role && $this->role->name === 'staff';
    }

    public function isGuest(): bool
    {
        return $this->role && $this->role->name === 'guest';
    }

    public function hasRole(string $role): bool
    {
        return $this->role && $this->role->name === $role;
    }
}