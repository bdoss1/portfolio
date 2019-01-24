<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Spiritix\LadaCache\Database\LadaCacheTrait;
use Yarmat\Seo\Models\Seo as Model;

/**
 * App\Models\Seo
 *
 * @property int $id
 * @property array|null $title
 * @property array|null $description
 * @property array|null $keywords
 * @property int $seoable_id
 * @property string $seoable_type
 * @property-read mixed $translations
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $seoable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereSeoableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereSeoableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereTitle($value)
 * @mixin \Eloquent
 */
class Seo extends Model
{
    use HasTranslations;
    use LadaCacheTrait;

    public $translatable = ['title', 'description', 'keywords'];
}
