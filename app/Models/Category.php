<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Books;

class Category extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function books(): HasMany
    {
        return $this->hasMany(Books::class);
    }

    // Helper method
    public function books_count(): int
    {
        return $this->books()->count();
    }
}