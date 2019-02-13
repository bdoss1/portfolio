<?php
/**
 * Created by PhpStorm.
 * User: yarmat
 * Date: 18.01.19
 * Time: 12:31
 */

namespace App\UseCases;


use App\Entities\Seo;
use App\Models\Page;
use App\Models\Portfolio;

class PortfolioUseCase
{
    const ITEM_LIMIT = 9;

    protected $page = null;

    public function itemsQuery($page = 1)
    {
        $skip = ($page - 1) * self::ITEM_LIMIT;
        $query = Portfolio::with(['categories' => function ($query) {
            $query->select(['title']);
        }])->orderBy('published_at', 'desc')
            ->select(['id', 'title', 'image', 'slug'])
            ->take(self::ITEM_LIMIT)
            ->published()
            ->translated()
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
        $query = Portfolio::skip($skip)->translated()->published()->select(['id'])->take(self::ITEM_LIMIT);
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
            $this->page = Page::whereSlug('portfolio')->first()->withFakes();
        }
        return $this->page;
    }

}
