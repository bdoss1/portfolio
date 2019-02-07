<?php

namespace App\Http\Controllers;

use App\Entities\Seo;
use App\Models\Category;
use App\Models\Page;
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

    public function index()
    {
        $items = $this->portfolioUseCase->itemsQuery()->get();

        $page = $this->portfolioUseCase->getPage();

        $this->seo()->metatags()->setTitle($page->meta_title ?? '');
        $this->seo()->metatags()->setDescription($page->meta_description ?? '');
        $this->seo()->metatags()->setKeywords($page->meta_keywords ?? '');

        $this->seo()->opengraph()->setTitle($page->meta_title ?? '');
        $this->seo()->opengraph()->setDescription($page->meta_description ?? '');

        $this->seo()->opengraph()->addProperty('locale', app()->getLocale());
        if (config('settings.logo')) $this->seo()->opengraph()->addImage(asset(config('settings.logo')));

        $moreCountItems = ($items->count() === $this->portfolioUseCase::ITEM_LIMIT)
            ? ($this->portfolioUseCase->moreCountItemsQuery(1)->get())->count()
            : 0;

        $isButtonVisible = $moreCountItems != 0;

        $categories = Category::whereHas('portfolios')->get(['title', 'slug']);

        return view('portfolio.index')->with(compact('items', 'moreCountItems', 'categories', 'isButtonVisible', 'page'));
    }

    public function show($slug, PortfolioHtmlService $htmlService)
    {
        $item = Portfolio::whereSlug($slug)->with(['categories', 'seo'])->firstOrFail();

        $next = Portfolio::where('id', '>', $item->id)->first(['slug', 'title']);

        $this->seo()->metatags()->setTitle($item->seo->title ?? '');
        $this->seo()->metatags()->setDescription($item->seo->description ?? '');
        $this->seo()->metatags()->setKeywords($item->seo->keywords ?? '');

        $this->seo()->opengraph()->setTitle($item->seo->title ?? '');
        $this->seo()->opengraph()->setDescription($item->seo->description ?? '');
        $this->seo()->opengraph()->addImage(asset($item->image));

        $this->seo()->opengraph()->setType('article');
        $this->seo()->opengraph()->setArticle([
            'published_time' => $item->published_at->toW3CString(),
            'modified_time' => $item->updated_at->toW3CString(),
            'author' => $item->user->name
        ]);

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
