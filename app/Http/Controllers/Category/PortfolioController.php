<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use App\Services\Portfolio\PortfolioService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    protected $portfolioService;

    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }

    public function show($slug)
    {
        $category = Category::whereSlug($slug)->with(['seo'])->firstOrFail();

        $seo = $category->seo;

        $items = $this->portfolioService->itemsWhereHasCategoryQuery($category->id)->get();

        $moreCountItems = ($items->count() === $this->portfolioService::ITEM_LIMIT)
            ? ($this->portfolioService->moreCountItemsWhereHasCategoryQuery($category->id)->get())->count()
            : 0;

        $isButtonVisible = $moreCountItems != 0;

        $categories = Category::whereHas('portfolios')->get(['title', 'slug']);

        return view('portfolio.index')->with(compact('items', 'moreCountItems', 'categories', 'isButtonVisible', 'category', 'seo'));
    }

    public function load(Request $request, $slug)
    {
        if (!$request->ajax()) abort(404);

        $category = Category::whereSlug($slug)->firstOrFail();

        $items = $this->portfolioService->itemsWhereHasCategoryQuery($category->id, $request->get('page'))->get();

        $renderedItems = null;

        if (!empty($items)) {
            foreach ($items as $item) {
                $renderedItems .= view()->make('portfolio._item', ['item' => $item])->render();
            }
        }

        $moreCountItems = ($items->count() == $this->portfolioService::ITEM_LIMIT)
            ? ($this->portfolioService->moreCountItemsWhereHasCategoryQuery($category->id, $request->get('page'))->get())->count()
            : 0;

        $isButtonVisible = $moreCountItems != 0;

        return response()->json([
            'success' => true,
            'message' => 'Items successfully downloading',
            'items' => $renderedItems,
            'more_btn' => [
                'is_visible' => $isButtonVisible,
                'count_items' => $moreCountItems
            ]
        ]);
    }
}
