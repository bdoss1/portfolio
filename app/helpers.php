<?php

if (!function_exists('is_home')) {
    function is_home()
    {
        return \Request::url() === route('index');
    }
}