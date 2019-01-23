<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Spiritix\LadaCache\Database\LadaCacheTrait;
use Yarmat\Seo\Models\Seo as Model;

class Seo extends Model
{
    use HasTranslations;
    use LadaCacheTrait;

    public $translatable = ['title', 'description', 'keywords'];
}
