<?php

namespace App\Http\Controllers;

use App\Entities\Seo;
use App\Models\Category;
use App\Models\Portfolio;
use App\UseCases\PortfolioUseCase;
use App\Services\PortfolioHtmlService;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{

    protected $portfolioUseCase;

    public function __construct(PortfolioUseCase $portfolioUseCase)
    {
        $this->portfolioUseCase = $portfolioUseCase;
    }

    public function index(Seo $seo)
    {
        $items = $this->portfolioUseCase->itemsQuery()->get();

        $seo->title = __('custom.portfolio');

        $moreCountItems = ($items->count() === $this->portfolioUseCase::ITEM_LIMIT)
            ? ($this->portfolioUseCase->moreCountItemsQuery(1)->get())->count()
            : 0;

        $isButtonVisible = $moreCountItems != 0;

        $categories = Category::whereHas('portfolios')->get(['title', 'slug']);

        return view('portfolio.index')->with(compact('items', 'moreCountItems', 'categories', 'isButtonVisible', 'seo'));
    }

    public function show($slug, PortfolioHtmlService $htmlService)
    {
        $item = Portfolio::whereSlug($slug)->with(['media', 'categories', 'seo'])->firstOrFail();

        $next = Portfolio::where('id', '>', $item->id)->first(['slug', 'title']);

        $seo = $item->seo;

        $htmlItems = $htmlService->get($item->dir_path);

        if (!$next) {
            $next = Portfolio::first(['slug', 'title']);
        }
        return view('portfolio.show')->with(compact('item', 'next', 'seo', 'htmlItems'));
    }

    public function load(Request $request)
    {
        if (!$request->ajax()) abort(405);

        $items = $this->portfolioUseCase->itemsQuery($request->get('page'))->get();

        $renderedItems = null;

        if (!empty($items)) {
            foreach ($items as $item) {
                $renderedItems .= view()->make('portfolio._item', ['item' => $item])->render();
            }
        }

        $moreCountItems = ($items->count() == $this->portfolioUseCase::ITEM_LIMIT)
            ? ($this->portfolioUseCase->moreCountItemsQuery($request->get('page'))->get())->count()
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
