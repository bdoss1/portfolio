<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
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
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Comment[] $comments
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog whereImage($value)
 */
class Blog extends Model implements SeoContract, CommentContract
{
    use HasTranslations;
    use HasSlug;
    use HasSeoTrait;
    use LadaCacheTrait;
    use HasCommentTrait;
    use CrudTrait;

    const STATUS_DRAFTED = 0;
    const STATUS_PUBLISHED = 1;

    public $translatable = ['title', 'description', 'content'];

    protected $dates = ['published_at', 'updated_at', 'created_at'];

    protected $fillable = ['title', 'description', 'content', 'link', 'image', 'user_id', 'published_at', 'status'];

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
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable');
    }

    public function scopePublished($query)
    {
        if (\Auth::user() && \Auth::user()->hasRole([User::ROLE_ADMIN])) {
            return $query;
        }

        return $query
            ->where('status', self::STATUS_PUBLISHED)
            ->where('published_at', '<=', now());
    }

    public function hasTranslation(string $key, string $locale = null): bool
    {
        $locale = $locale ?: $this->getLocale();
        return isset($this->getTranslations($key)[$locale]);
    }
}
