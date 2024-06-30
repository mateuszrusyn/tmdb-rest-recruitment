<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieGenre extends Model
{
    use HasFactory;

    protected $fillable = ['tmdb_id'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_movie_genre');
    }

    public function translations()
    {
        return $this->hasMany(MovieGenreTranslation::class);
    }
}
