<?php

namespace App\Http\Controllers;

use App\Entities\Seo;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug)
    {
        $page = Page::whereSlug($slug)->firstOrFail()->withFakes();

        if (in_array($page->template, ['main', 'service'])) abort(404);

        $this->seo()->metatags()->setTitle($page->meta_title ?? '');
        $this->seo()->metatags()->setDescription($page->meta_description ?? '');
        $this->seo()->metatags()->setKeywords($page->meta_keywords ?? '');

        $this->seo()->opengraph()->setTitle($page->meta_title ?? '');
        $this->seo()->opengraph()->setDescription($page->meta_description ?? '');

        $this->seo()->opengraph()->addProperty('locale', app()->getLocale());
        if (config('settings.logo')) $this->seo()->opengraph()->addImage(asset(config('settings.logo')));

        return view('page.' . $page->template)->with(compact('page'));
    }
}
