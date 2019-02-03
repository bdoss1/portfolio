<?php

namespace App\Http\Controllers;

use App\Entities\Seo;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug, Seo $seo)
    {
        $page = Page::whereSlug($slug)->firstOrFail()->withFakes();

        if (in_array($page->template, ['main', 'service'])) abort(404);

        $seo->title = $page->meta_title ?? '';
        $seo->description = $page->meta_description ?? '';
        $seo->keywords = $page->meta_keywords ?? '';

        return view('page.' . $page->template)->with(compact('page', 'seo'));
    }
}
