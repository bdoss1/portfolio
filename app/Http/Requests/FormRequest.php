<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class FormRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (\Auth::check()) {
            return [
                'message' => 'required'
            ];
        } else {
            return [
                'name' => 'required|string|alpha',
                'email' => 'required|email',
                'message' => 'required'
            ];
        }

    }
}
