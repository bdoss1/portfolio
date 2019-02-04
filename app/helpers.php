<?php

if (!function_exists('is_home')) {
    function is_home()
    {
        return \Request::url() === route('index');
    }
}

if (!function_exists('hide_redirect')) {
    function hide_redirect($link)
    {
        return route('redirect', encrypt($link));
    }
}
