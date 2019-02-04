<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spiritix\LadaCache\Database\LadaCacheTrait;
use Yarmat\Seo\Traits\HasSeoTrait;
use Yarmat\Seo\Contracts\SeoContract;

/**
 * App\Models\Portfolio
 *
 * @property int $id
 * @property array $title
 * @property array $description
 * @property string|null $link
 * @property string|null $dir_path
 * @property int $slug
 * @property \Illuminate\Support\Carbon $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property-read mixed $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \App\Models\Seo $seo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereDirPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio withCacheCooldownSeconds($seconds)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property array $content
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Portfolio whereImage($value)
 */
class Portfolio extends Model implements SeoContract
{
    use HasTranslations;
    use HasSlug;
    use HasSeoTrait;
    use LadaCacheTrait;
    use CrudTrait;

    public $translatable = ['title', 'description', 'content'];

    protected $dates = ['published_at', 'updated_at', 'created_at'];

    protected $fillable = ['title', 'description', 'content', 'link', 'user_id', 'dir_path', 'published_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable');
    }
}
