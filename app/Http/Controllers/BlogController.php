<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;
use App\Models\Seo;
use App\UseCases\BlogUseCase;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blogUseCase;

    public function __construct(BlogUseCase $blogUseCase)
    {
        $this->blogUseCase = $blogUseCase;
    }

    public function index()
    {
        $items = $this->blogUseCase->itemsQuery()->get();

        $page = $this->blogUseCase->getPage();

        $this->seo()->metatags()->setTitle($page->meta_title ?? $page->title);
        $this->seo()->metatags()->setDescription($page->meta_description ?? '');
        $this->seo()->metatags()->setKeywords($page->meta_keywords ?? '');

        $this->seo()->opengraph()->setTitle($page->meta_title ?? $page->title);
        $this->seo()->opengraph()->setDescription($page->meta_description ?? '');

        $this->seo()->opengraph()->addProperty('locale', app()->getLocale());
        if (config('settings.logo')) $this->seo()->opengraph()->addImage(asset(config('settings.logo')));

        $moreCountItems = ($items->count() === $this->blogUseCase::ITEM_LIMIT)
            ? ($this->blogUseCase->moreCountItemsQuery(1)->get())->count()
            : 0;

        $isButtonVisible = $moreCountItems != 0;

        $categories = Category::whereHas('blogs')->get(['title', 'slug']);

        return view('blog.index')->with(compact('items', 'moreCountItems', 'categories', 'isButtonVisible', 'page'));
    }

    public function show($slug)
    {
        $item = Blog::whereSlug($slug)->published()->translated()->with(['categories', 'seo', 'user'])->firstOrFail();

        $this->seo()->metatags()->setTitle($item->seo->title ?? $item->title);
        $this->seo()->metatags()->setDescription($item->seo->description ?? '');
        $this->seo()->metatags()->setKeywords($item->seo->keywords ?? '');

        $this->seo()->opengraph()->setTitle($item->seo->title ?? $item->title);
        $this->seo()->opengraph()->setDescription($item->seo->description ?? '');
        $this->seo()->opengraph()->addImage(asset($item->image));

        return view('blog.show')->with(compact('item', 'seo'));
    }

    public function load(Request $request)
    {
        if (!$request->ajax()) abort(405);

        $items = $this->blogUseCase->itemsQuery($request->get('page'))->get();

        $renderedItems = null;

        if (!empty($items)) {
            foreach ($items as $item) {
                $renderedItems .= view()->make('blog._item', ['item' => $item])->render();
            }
        }

        $moreCountItems = ($items->count() == $this->blogUseCase::ITEM_LIMIT)
            ? ($this->blogUseCase->moreCountItemsQuery($request->get('page'))->get())->count()
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
