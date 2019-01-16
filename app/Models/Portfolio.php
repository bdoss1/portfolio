<?php

namespace App\Models;

use App\Traits\HasSeoTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\SlugOptions;

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
 */
class Portfolio extends Model implements HasMedia
{
    use HasTranslations;
    use HasSlug;
    use HasMediaTrait;
    use HasSeoTrait;

    public $translatable = ['title', 'description'];

    protected $dates = ['published_at', 'updated_at', 'created_at'];

    protected $fillable = ['title', 'description', 'link', 'user_id', 'dir_path', 'published_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('preview')->singleFile();
        $this->addMediaCollection('images');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('small')
            ->crop(Manipulations::CROP_CENTER, '70', '70');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
