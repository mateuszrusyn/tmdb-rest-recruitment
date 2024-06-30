<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieGenreTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['serie_genre_id', 'language_id', 'name'];

    public function serieGenre()
    {
        return $this->belongsTo(SerieGenre::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
