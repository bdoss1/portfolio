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
    protected static $public_folder = 'public';

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
            if (!\Storage::exists(self::$public_folder . '/' . self::$folder)) {
                \Storage::makeDirectory(self::$public_folder . '/' . self::$folder, 777, true);
            }

            $image = self::$public_folder . '/' . str_replace('storage/', '', $image);

            $imagePath = \Storage::path($image);

            $imageExtension = pathinfo($imagePath)['extension'];
            $imageResized = self::$public_folder . '/' . self::$folder . '/' . md5($imagePath) . $width . 'x' . $height . '&type=' . $type . '&q=' . $quality . '.' . $imageExtension;
            $imageResizedPath = \Storage::path($imageResized);

            if (!file_exists($imageResizedPath)) {
                ini_set('memory_limit', '256M');
                $image = \Image::make($imagePath);
                $image->$type($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save($imageResizedPath, $quality);
            }

            return \Storage::url($imageResized);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
