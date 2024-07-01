<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SerieGenreTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['serie_genre_id', 'language_id', 'name'];

    public function serieGenre(): BelongsTo
    {
        return $this->belongsTo(SerieGenre::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
