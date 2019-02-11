<?php
/**
 * Created by PhpStorm.
 * User: yarmat
 * Date: 18.01.19
 * Time: 12:31
 */

namespace App\UseCases;


use App\Entities\Seo;
use App\Models\Blog;
use App\Models\Page;

class BlogUseCase
{
    const ITEM_LIMIT = 9;

    protected $page;

    public function itemsQuery($page = 1)
    {
        $skip = ($page - 1) * self::ITEM_LIMIT;
        $query = Blog::with(['categories' => function ($query) {
            $query->select(['title', 'slug']);
        }, 'user' => function ($query) {
            $query->select(['name', 'id']);
        }])->orderBy('published_at', 'desc')
            ->select(['id', 'title', 'image', 'description', 'published_at', 'slug', 'user_id'])
            ->take(self::ITEM_LIMIT)
            ->translated()
            ->published()
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
        $query = Blog::skip($skip)->select(['id'])->published()->take(self::ITEM_LIMIT);
        return $query;
    }

    public function moreCountItemsWhereHasCategoryQuery($categoryId, $page = 1)
    {
        return $this->moreCountItemsQuery($page)
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->whereId($categoryId);
            });
    }

    public function getPage()
    {
        if ($this->page === null) {
            $this->page = Page::whereSlug('blog')->first()->withFakes();
        }
        return $this->page;
    }

}
