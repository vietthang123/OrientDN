<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('post_create');
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
                'unique:posts',
            ],
            'categories.*' => [
                'integer',
                'required',
            ],
            'categories'   => [
                'array',
                'required',
            ],
            'title'        => [
                'required',
            ],
            'content'        => [
                'required',
            ],
            'image.*'      => [
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
            'image'        => [
                'required',
            ],
        ];
    }
}