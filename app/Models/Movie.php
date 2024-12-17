<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // Optional: Define the table name explicitly (if not the default 'movies')
    // protected $table = 'movies';

    // Fields that can be mass assigned
    protected $fillable = ['title', 'release_year', 'quality_available', 'viewer_indications', 'genres'];

    // Optional: Define fields that should be cast to specific types
    protected $casts = [
        'release_date' => 'date',
        'duration' => 'integer',
    ];
}
