<?php
/**
 * Created by PhpStorm.
 * User: yaramT
 * Date: 31.07.2018
 * Time: 1:23
 */

namespace App\Services;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ThumbService
{

    protected static $folder = 'thumbnails';

    public static function resize($image, $width = null, $height = null, $quality = 90)
    {
        return self::run('resize', $image, $width, $height, $quality);
    }

    public static function fit($image, $width = null, $height = null, $quality = 90)
    {
        return self::run('fit', $image, $width, $height, $quality);
    }

    private static function run($type = 'resize', $image, $width = null, $height = null, $quality = 90)
    {
        try {
            if (!\Storage::disk('public')->exists(self::$folder)) {
                \Storage::disk('public')->makeDirectory(self::$folder, 777, true);
            }

            $image = str_replace('storage/', '', $image);

            $imagePath = \Storage::disk('public')->path($image);

            $imageExtension = pathinfo($imagePath)['extension'];
            $imageResized = self::$folder . '/' . md5($imagePath) . $width . 'x' . $height . '&type=' . $type . '&q=' . $quality . '.' . $imageExtension;
            $imageResizedPath = \Storage::disk('public')->path($imageResized);

            if (!file_exists($imageResizedPath)) {
                ini_set('memory_limit', '256M');
                $image = \Image::make($imagePath);
                $image->$type($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save($imageResizedPath, $quality);
            }

            return \Storage::disk('public')->url($imageResized);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
