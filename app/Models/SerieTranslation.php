<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SerieTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['serie_id', 'language_id', 'name', 'overview'];

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
