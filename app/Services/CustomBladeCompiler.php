<?php
/**
 * Created by PhpStorm.
 * User: yarmat
 * Date: 07.02.19
 * Time: 10:59
 */

namespace App\Services;


use Symfony\Component\Debug\Exception\FatalThrowableError;

class CustomBladeCompiler
{
    public static function render($value, array $args = array())
    {
        $generated = \Blade::compileString($value);
        $generated = str_replace('&quot;', "'", $generated);

        ob_start() and extract($args, EXTR_SKIP);

        // We'll include the view contents for parsing within a catcher
        // so we can avoid any WSOD errors. If an exception occurs we
        // will throw it out to the exception handler.
        try {
            eval('?>' . $generated);
        }

            // If we caught an exception, we'll silently flush the output
            // buffer so that no partially rendered views get thrown out
            // to the client and confuse the user with junk.
        catch (\Exception $e) {
            ob_get_clean();
            throw $e;
        }

        $content = ob_get_clean();

        return $content;
    }
}