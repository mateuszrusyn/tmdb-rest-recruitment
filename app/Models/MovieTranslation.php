<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovieTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'language_id', 'title', 'overview'];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
