<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    const ITEM_LIMIT = 10;

    public function index()
    {
        $items = Portfolio::with(['media', 'categories'])
            ->orderBy('published_at', 'desc')
            ->take(self::ITEM_LIMIT)
            ->get(['title', 'slug', 'id']);

        return view('portfolio.index')->with(compact('items'));
    }

    public function show($slug)
    {
        $item = Portfolio::whereSlug($slug)->with(['media', 'categories'])->firstOrFail();
        $next = Portfolio::where('id', '>', $item->id)->first(['slug', 'title']);
        if (!$next) {
            $next = Portfolio::first(['slug', 'title']);
        }
        return view('portfolio.show')->with(compact('item', 'next'));
    }

    public function load($page)
    {
        return response()->json([
            'success' => true,
            'message' => 'Items successfully downloading',
            'items' => []
        ]);
    }
}
