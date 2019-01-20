<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
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

    public function index(Seo $seo)
    {
        $items = $this->blogUseCase->itemsQuery()->get();

        $seo->title = __('custom.blog');

        $moreCountItems = ($items->count() === $this->blogUseCase::ITEM_LIMIT)
            ? ($this->blogUseCase->moreCountItemsQuery(1)->get())->count()
            : 0;

        $isButtonVisible = $moreCountItems != 0;

        $categories = Category::whereHas('blogs')->get(['title', 'slug']);

        return view('blog.index')->with(compact('items', 'moreCountItems', 'categories', 'isButtonVisible', 'seo'));
    }

    public function show($slug)
    {
        $item = Blog::whereSlug($slug)->with(['media', 'categories', 'seo', 'user'])->firstOrFail();

        $seo = $item->seo;

        return view('blog.show')->with(compact('item', 'seo'));
    }

    public function load(Request $request)
    {
        if (!$request->ajax()) abort(405);

        $items = $this->blogUseCase->itemsQuery($request->get('page'))->get();

        $renderedItems = null;

        if (!empty($items)) {
            foreach ($items as $item) {
                $renderedItems .= view()->make('portfolio._item', ['item' => $item])->render();
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
