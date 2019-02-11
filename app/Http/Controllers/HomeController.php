<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Portfolio;
use App\UseCases\PortfolioUseCase;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(PortfolioUseCase $portfolioUseCase)
    {
        $page = Page::whereSlug('main')->firstOrFail()->withFakes();
        $portfolioItems = $portfolioUseCase->itemsQuery()->get();
        $portfolioItemsCount = Portfolio::count();

        $this->seo()->metatags()->setTitle($page->meta_title ?? $page->title, false);
        $this->seo()->metatags()->setDescription($page->meta_description ?? '');
        $this->seo()->metatags()->setKeywords($page->meta_keywords ?? '');

        $this->seo()->opengraph()->setTitle($page->meta_title ?? $page->title);
        $this->seo()->opengraph()->setDescription($page->meta_description ?? '');
        $this->seo()->opengraph()->addProperty('locale', app()->getLocale());
        if (config('settings.logo')) $this->seo()->opengraph()->addImage(asset(config('settings.logo')));

        return view('index')->with(compact('portfolioItems', 'portfolioItemsCount', 'page'));
    }
}
