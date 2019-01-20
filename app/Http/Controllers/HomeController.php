<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\UseCases\PortfolioUseCase;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(PortfolioUseCase $portfolioUseCase)
    {
        $portfolioItems = $portfolioUseCase->itemsQuery()->get();
        $portfolioItemsCount = Portfolio::count();
        return view('index')->with(compact('portfolioItems', 'portfolioItemsCount'));
    }
}
