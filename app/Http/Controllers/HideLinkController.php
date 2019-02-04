<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HideLinkController extends Controller
{
    public function redirect(Request $request, $link)
    {
        $link = decrypt($link);

        return redirect()->to($link);
    }
}
