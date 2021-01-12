<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\Admin\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostApiController extends Controller
{
    // use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new PostResource(Post::with(['user', 'categories'])->get());
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        $post->categories()->sync($request->input('categories', []));

        // if ($request->input('image', false)) {
        //     $post->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        // }

        return (new PostResource($post))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Post $post)
    {
        abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new PostResource($post->load(['user', 'categories']));
    }


    //
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        $post->categories()->sync($request->input('categories', []));

        // if ($request->input('image', false)) {
        //     if (!$post->image || $request->input('image') !== $post->image->file_name) {
        //         if ($post->image) {
        //             $post->image->delete();
        //         }

        //         $post->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        //     }
        // } elseif ($post->image) {
        //     $post->image->delete();
        // }

        return (new PostResource($post))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
    //


    //delete
    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $post->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}