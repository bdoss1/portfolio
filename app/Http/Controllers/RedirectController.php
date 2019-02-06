<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function to(Request $request)
    {
        $link = decrypt($request->get('value'));

        return redirect()->away($link);
    }
}
