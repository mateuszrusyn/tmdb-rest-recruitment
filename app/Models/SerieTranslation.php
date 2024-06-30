<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['serie_id', 'language_id', 'name', 'overview'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
