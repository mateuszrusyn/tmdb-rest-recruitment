<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['tmdb_id', 'release_date', 'vote_average'];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(MovieGenre::class, 'movie_movie_genre');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(MovieTranslation::class);
    }
}
