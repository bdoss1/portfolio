<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Form
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string|null $name
 * @property string|null $email
 * @property string $message
 * @property string|null $custom
 * @property int|null $user_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User|null $user
 */
class Form extends Model
{
    protected $fillable = ['title', 'url', 'name', 'email', 'message', 'custom', 'user_id', 'status'];

    protected $casts = [
        'custom' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
