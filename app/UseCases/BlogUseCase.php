<?php
/**
 * Created by PhpStorm.
 * User: yarmat
 * Date: 18.01.19
 * Time: 12:31
 */

namespace App\UseCases;


use App\Models\Blog;

class BlogUseCase
{
    const ITEM_LIMIT = 9;

    public function itemsQuery($page = 1)
    {
        $skip = ($page - 1) * self::ITEM_LIMIT;
        $query = Blog::with(['media', 'categories' => function ($query) {
            $query->select(['title', 'slug']);
        }, 'user' => function ($query) {
            $query->select(['name', 'id']);
        }])->orderBy('published_at', 'desc')
            ->select(['id', 'title', 'description', 'slug', 'user_id'])
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
        $query = Blog::skip($skip)->select(['id'])->take(self::ITEM_LIMIT);
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
