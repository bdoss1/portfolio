<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Services\Portfolio\PortfolioService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(PortfolioService $portfolioService)
    {
        $portfolioItems = $portfolioService->itemsQuery()->get();
        $portfolioItemsCount = Portfolio::count();
        return view('index')->with(compact('portfolioItems', 'portfolioItemsCount'));
    }
}
