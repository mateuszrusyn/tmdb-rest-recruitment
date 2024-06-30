<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'language_id', 'title', 'overview'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
