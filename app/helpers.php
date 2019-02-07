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
        return route('redirect');
    }
}

if (!function_exists('redirect_item')) {
    function redirect_item($link, $text = 'link')
    {
        return "<span class=\"link-style show-me_js\" data-value=\"" . encrypt($link) . "\">" . $text . "</span>";
    }
}

