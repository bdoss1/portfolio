<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function to(Request $request)
    {
        $cryptLink = $request->get('value');

        if (empty($cryptLink)) abort(404);

        $link = decrypt($cryptLink);

        return redirect()->away($link);
    }
}
