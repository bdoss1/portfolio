<?php
/**
 * Created by PhpStorm.
 * User: yarmat
 * Date: 16.01.19
 * Time: 11:18
 */

namespace App\Traits;


trait HasSeoTrait
{
    public function seo()
    {
        return $this->morphOne('App\Models\Seo', 'seoable')->withDefault();
    }

    public function saveSeo($attributes)
    {
        return $this->seo()->updateOrCreate(['seoable_id' => $this->id], $attributes);
    }

    public function destroySeo()
    {
        return $this->seo()->delete();
    }
}