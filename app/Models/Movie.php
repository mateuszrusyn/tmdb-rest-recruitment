<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['tmdb_id', 'release_date', 'vote_average'];

    public function genres()
    {
        return $this->belongsToMany(MovieGenre::class, 'movie_movie_genre');
    }

    public function translations()
    {
        return $this->hasMany(MovieTranslation::class);
    }
}
