<?php

namespace App\Http\Requests;

use App\Models\Slide;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSlideRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('slide_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}