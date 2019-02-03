<?php

namespace App\Http\Controllers;

use App\Entities\Seo;
use App\Models\Page;
use App\Models\Portfolio;
use App\UseCases\PortfolioUseCase;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(PortfolioUseCase $portfolioUseCase, Seo $seo)
    {
        $page = Page::whereSlug('main')->firstOrFail()->withFakes();
        $portfolioItems = $portfolioUseCase->itemsQuery()->get();
        $portfolioItemsCount = Portfolio::count();

        $seo->title = $page->meta_title ?? '';
        $seo->description = $page->meta_description ?? '';
        $seo->keywords = $page->meta_keywords ?? '';

        return view('index')->with(compact('portfolioItems', 'portfolioItemsCount', 'page', 'seo'));
    }
}
