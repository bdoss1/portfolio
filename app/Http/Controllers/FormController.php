<?php

namespace App\Http\Controllers;

use App\Events\FormContactStored;
use App\Events\Forms\ContactStored;
use App\Events\FormSaved;
use App\Http\Requests\FormRequest;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function contact(FormRequest $request)
    {
        $data = $this->transformData($request->all(), 'Contact');

        $form = Form::create($data);

        event(new FormContactStored($form));

        if (!$request->ajax()) return back()->with($this->responseSuccess());

        return response()->json($this->responseSuccess());
    }

    private function transformData(array $data, $title = null)
    {
        if (count($data) < 1) return false;

        $transformData = [];

        if (\Auth::check()) {
            $transformData['user_id'] = \Auth::user()->id;
        } else {
            $transformData['name'] = $data['name'];
            $transformData['email'] = $data['email'];
        }

        $transformData['message'] = $data['message'];
        $transformData['custom'] = $data['custom'] ?? [];
        $transformData['url'] = url()->previous();
        $transformData['title'] = $title;

        return $transformData;
    }

    private function responseSuccess($message = 'Your form is saved')
    {
        return [
            'success' => true,
            'message' => $message
        ];
    }
}
