<?php
/**
 * Created by PhpStorm.
 * User: yarmat
 * Date: 17.01.19
 * Time: 15:23
 */

namespace App\Services;


use App\Entities\PortfolioHtmlItem;

class PortfolioHtmlService
{
    public function get($dir = null)
    {
        if (empty($dir)) return false;

        $path = \Storage::disk('portfolio_html')->path($dir);

        if (!is_dir($path)) return false; // Dir is not exist

        $items = scandir($path);

        if (count($items) === 2) return false; // Dir is empty

        $htmlItems = [];
        foreach ($items as $item) {
            $extension = pathinfo($item, PATHINFO_EXTENSION);
            if ($extension === 'html') {
                $htmlItem = new PortfolioHtmlItem();
                $htmlItem->title = $item;
                $htmlItem->url = \Storage::disk('portfolio_html')->url($dir . '/' . $item);
                $htmlItems[] = $htmlItem;
            }
        }

        return $htmlItems;
    }
}
