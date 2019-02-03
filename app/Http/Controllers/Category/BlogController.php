<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use App\UseCases\BlogUseCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    protected $blogUseCase;

    public function __construct(BlogUseCase $blogUseCase)
    {
        $this->blogUseCase = $blogUseCase;
    }

    public function show($slug)
    {
        $category = Category::whereSlug($slug)->with(['seo'])->firstOrFail();

        $page = $this->blogUseCase->getPage();

        $seo = $category->seo;

        $items = $this->blogUseCase->itemsWhereHasCategoryQuery($category->id)->get();

        $moreCountItems = ($items->count() === $this->blogUseCase::ITEM_LIMIT)
            ? ($this->blogUseCase->moreCountItemsWhereHasCategoryQuery($category->id)->get())->count()
            : 0;

        $isButtonVisible = $moreCountItems != 0;

        $categories = Category::whereHas('portfolios')->get(['title', 'slug']);

        return view('blog.index')->with(compact('items', 'moreCountItems', 'categories', 'isButtonVisible', 'category', 'seo', 'page'));
    }

    public function load(Request $request, $slug)
    {
        if (!$request->ajax()) abort(405);

        $category = Category::whereSlug($slug)->firstOrFail();

        $items = $this->blogUseCase->itemsWhereHasCategoryQuery($category->id, $request->get('page'))->get();

        $renderedItems = null;

        if (!empty($items)) {
            foreach ($items as $item) {
                $renderedItems .= view()->make('blog._item', ['item' => $item])->render();
            }
        }

        $moreCountItems = ($items->count() == $this->blogUseCase::ITEM_LIMIT)
            ? ($this->blogUseCase->moreCountItemsWhereHasCategoryQuery($category->id, $request->get('page'))->get())->count()
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
