<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Spiritix\LadaCache\Database\LadaCacheTrait;
use Yarmat\Comment\Contracts\CommentContract;
use Yarmat\Comment\Traits\HasCommentTrait;
use Yarmat\Seo\Traits\HasSeoTrait;
use Yarmat\Seo\Contracts\SeoContract;

/**
 * App\Models\Blog
 *
 * @property int $id
 * @property array $title
 * @property array $description
 * @property array $content
 * @property string|null $link
 * @property string $slug
 * @property \Illuminate\Support\Carbon $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read mixed $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \App\Models\Seo $seo
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog withCacheCooldownSeconds($seconds)
 * @mixin \Eloquent
 */
class Blog extends Model implements HasMedia, SeoContract, CommentContract
{
    use HasTranslations;
    use HasSlug;
    use HasMediaTrait;
    use HasSeoTrait;
    use LadaCacheTrait;
    use HasCommentTrait;

    public $translatable = ['title', 'description', 'content'];

    protected $dates = ['published_at', 'updated_at', 'created_at'];

    protected $fillable = ['title', 'description', 'content', 'link', 'user_id', 'published_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('preview')->singleFile()->useDisk('blog_images');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('small')
            ->crop(Manipulations::CROP_CENTER, '410', '270')
            ->quality(85);

        $this->addMediaConversion('big')
            ->width(1400)
            ->quality(90);
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable');
    }
}
