<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class categories extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'name', 'description'
    ];

    // Relationships
    public function books(): HasMany
    {
        return $this->hasMany(books::class);
    }

    // Helper method
    public function books_count(): int
    {
        return $this->books()->count();
    }
}