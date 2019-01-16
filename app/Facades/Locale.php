<?php
/**
 * Created by PhpStorm.
 * User: yarmat
 * Date: 16/12/18
 * Time: 12:28
 */

namespace App\Facades;

use App\Services\LocaleService;
use Illuminate\Support\Facades\Facade;


class Locale extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LocaleService::SERVICE_NAME;
    }
}
