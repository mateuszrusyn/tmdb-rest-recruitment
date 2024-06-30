<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = ['tmdb_id', 'first_air_date', 'vote_average'];

    public function genres()
    {
        return $this->belongsToMany(SerieGenre::class);
    }

    public function translations()
    {
        return $this->hasMany(SerieTranslation::class);
    }
}
