<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovieGenreTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['movie_genre_id', 'language_id', 'name'];

    public function movieGenre(): BelongsTo
    {
        return $this->belongsTo(MovieGenre::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
