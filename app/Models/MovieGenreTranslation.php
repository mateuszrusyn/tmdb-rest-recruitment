<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieGenreTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['movie_genre_id', 'language_id', 'name'];

    public function movieGenre()
    {
        return $this->belongsTo(MovieGenre::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
