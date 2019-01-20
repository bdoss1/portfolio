<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Yarmat\Seo\Models\Seo as Model;

class Seo extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description', 'keywords'];
}
