<?php
/**
 * Created by PhpStorm.
 * User: yarmat
 * Date: 03/02/19
 * Time: 18:08
 */

namespace App\Http\Controllers\Admin;


class PageCrudController extends \Backpack\PageManager\app\Http\Controllers\Admin\PageCrudController
{
    public function create($template = false)
    {
        if (request()->has('template')) {
            $template = request('template');
        }

        return parent::create($template);
    }
}
