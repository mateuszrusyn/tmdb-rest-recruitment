<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SerieGenre extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['tmdb_id'];

    public function series(): BelongsToMany
    {
        return $this->belongsToMany(Serie::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(SerieGenreTranslation::class);
    }
}
