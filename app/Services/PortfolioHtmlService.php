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

        $dir = str_replace('storage/', '', $dir);

        $path = \Storage::disk('public')->path($dir);

        if (!is_dir($path)) {
            $pathArray = explode('/', $path);
            unset($pathArray[count($pathArray) - 1]);
            $path = implode('/', $pathArray);

            if (!is_dir($path)) return false;

            $dirArray = explode('/', $dir);
            unset($dirArray[count($dirArray) - 1]);
            $dir = implode('/', $dirArray);
        } // Dir is not exist

        $items = scandir($path);

        if (count($items) === 2) return false; // Dir is empty

        $htmlItems = [];
        foreach ($items as $item) {
            $extension = pathinfo($item, PATHINFO_EXTENSION);
            if ($extension === 'html') {
                $htmlItem = new PortfolioHtmlItem();
                $htmlItem->title = $item;
                $htmlItem->url = \Storage::disk('public')->url($dir . '/' . $item);
                $htmlItems[] = $htmlItem;
            }
        }

        return $htmlItems;
    }
}
