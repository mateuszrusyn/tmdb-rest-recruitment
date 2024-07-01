<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MovieGenre extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['tmdb_id'];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_movie_genre');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(MovieGenreTranslation::class);
    }
}
