<?php

namespace App\Widgets;

use App\Models\Review;
use Arrilot\Widgets\AbstractWidget;

class LastReviews extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    protected $items;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $items = Review::orderBy('created_at', 'DESC')->get();

        return view('widgets.last_reviews')->with(compact('items'));
    }
}
