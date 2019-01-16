<?php
/**
 * Created by PhpStorm.
 * User: yarmat
 * Date: 16/12/18
 * Time: 14:19
 */

namespace App\Services;


class LocaleService
{
    const SERVICE_NAME = 'LocaleService';

    public function getDefaultLocale()
    {
        return config('app.locale');
    }

    public function getLocales()
    {
        return [
            'ru', 'en'
        ];
    }

    public function current()
    {
        $uri = \Request::path();

        $segmentsURI = explode('/', $uri);

        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], $this->getLocales())) {

            if ($segmentsURI[0] != $this->getDefaultLocale()) return $segmentsURI[0];

        }
        return null;
    }

    public function getCurrentLocale()
    {
        return is_null($this->current()) ? $this->getDefaultLocale() : $this->current();
    }
}
