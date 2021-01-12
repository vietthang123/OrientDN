<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePostRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_edit');
    }

    public function rules()
    {
        return [
            'user_id'      => [
                'required',
                'integer',
            ],
            'name'         => [
                'string',
                'min:6',
                'required',
                'unique:posts,name,' . request()->route('post')->id,
            ],
            'categories.*' => [
                'integer',
            ],
            'categories'   => [
                'array',
            ],
            'title'        => [
                'required',
            ],
            'slug'         => [
                'string',
                'nullable',
            ],
            'status'       => [
                'string',
                'nullable',
            ],
        ];
    }
}