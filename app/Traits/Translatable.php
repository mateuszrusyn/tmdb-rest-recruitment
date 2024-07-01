<?php

namespace App\Traits;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;

trait Translatable
{
    public static function withTranslations(string $languageCode): Builder
    {
        $language = Language::where('code', $languageCode)->first();

        if (!$language) {
            $language = Language::first();
        }

        return self::with(['translations' => function ($query) use ($language) {
            $query->where('language_id', $language->id);
        }]);
    }
}
