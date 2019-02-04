<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PortfolioFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function categories($ids)
    {
        return $this->whereHas('categories', function ($query) use ($ids) {
            $query->whereIn('id', $ids);
        });
    }

    public function title($value)
    {
        return $this->where('title->ru', $value);
    }

}
