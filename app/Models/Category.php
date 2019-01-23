<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Spiritix\LadaCache\Database\LadaCacheTrait;
use Yarmat\Seo\Traits\HasSeoTrait;
use Yarmat\Seo\Contracts\SeoContract;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $categoryable_id
 * @property string $categoryable_type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCategoryableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereTitle($value)
 * @mixin \Eloquent
 * @property-read mixed $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Portfolio[] $portfolios
 * @property-read \App\Models\Seo $seo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category withCacheCooldownSeconds($seconds)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog[] $blogs
 */
class Category extends Model implements SeoContract
{
    use HasTranslations;
    use HasSlug;
    use LadaCacheTrait;
    use HasSeoTrait;

    public $translatable = ['title'];

    public $timestamps = false;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function portfolios()
    {
        return $this->morphedByMany(Portfolio::class, 'categoriable');
    }

    public function blogs()
    {
        return $this->morphedByMany(Blog::class, 'categoriable');
    }
}
