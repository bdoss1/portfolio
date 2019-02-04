<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spiritix\LadaCache\Database\LadaCacheTrait;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property string $author_name
 * @property string $author_url
 * @property string $content
 * @property string|null $image
 * @property string|null $review_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereAuthorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereAuthorUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereReviewUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    use CrudTrait;
    use LadaCacheTrait;

    protected $fillable = ['author_name', 'author_url', 'content', 'review_url', 'image'];
}
