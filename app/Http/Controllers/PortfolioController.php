<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('portfolio.index');
    }

    public function show(Portfolio $item)
    {
        return view('portfolio.show')->with(compact('item'));
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
