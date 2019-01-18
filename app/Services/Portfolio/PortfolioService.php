<?php
/**
 * Created by PhpStorm.
 * User: yarmat
 * Date: 18.01.19
 * Time: 12:31
 */

namespace App\Services\Portfolio;


use App\Models\Portfolio;

class PortfolioService
{
    const ITEM_LIMIT = 9;

    public function itemsQuery($page = 1)
    {
        $skip = ($page - 1) * self::ITEM_LIMIT;
        $query = Portfolio::with(['media', 'categories' => function ($query) {
            $query->select(['title']);
        }])->orderBy('published_at', 'desc')
            ->select(['id', 'title', 'slug'])
            ->take(self::ITEM_LIMIT)
            ->skip($skip);

        return $query;
    }

    public function itemsWhereHasCategoryQuery($categoryId, $page = 1)
    {
        return $this->itemsQuery($page)
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->whereId($categoryId);
            });
    }

    public function moreCountItemsQuery($page = 1)
    {
        $skip = $page * self::ITEM_LIMIT;
        $query = Portfolio::skip($skip)->select(['id'])->take(self::ITEM_LIMIT);
        return $query;
    }

    public function moreCountItemsWhereHasCategoryQuery($categoryId, $page = 1)
    {
        return $this->moreCountItemsQuery($page)
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->whereId($categoryId);
            });
    }
}