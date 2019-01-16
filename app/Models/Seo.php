<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Seo
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $keywords
 * @property int $seoable_id
 * @property string $seoable_type
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
 * @property-read mixed $translations
 */
class Seo extends Model
{
    use HasTranslations;

    public $timestamps = false;

    public $translatable = ['title', 'description', 'keywords'];

    protected $fillable = ['title', 'description', 'keywords'];

    public function seoable()
    {
        return $this->morphTo();
    }


}
