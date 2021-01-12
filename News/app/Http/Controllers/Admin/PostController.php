<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class PostController extends Controller
{
    // use MediaUploadingTrait;

    public function index(Request $request)
    {
        if(Gate::denies('post_access')){
            return response()->view('admin.error.403');
        }
        $user = User::orderBy('id')->get();    
        // $user = Auth::user();
        $posts = Post::with(['user', 'categories', 'media']);
        $categories = Category::orderBy('id','desc')->get();


        if($request->category){
            $posts->whereHas('categories',function ($q) use ($request){
                $q->where('categories.name', '=', $request->category);
            });
        }
        if($request->author){
            $posts->where('user_id', '=', $request->author);
        }

        if($request->status){
            $posts->where('status', '=', $request->status);
        }

        if($request->start){
            if($request->end){
                $posts->where('created_at', '>=', $request->start)
                           ->where('created_at', '<=', $request->end);
            }
            else{
                $posts->where('created_at', '>=', $request->start);
            }
        }
        if($request->end){
            if($request->start){
                $posts->where('created_at', '>=', $request->start)
                           ->where('created_at', '<=', $request->end);
            }
            else{
                $posts->where('created_at', '<=', $request->end);
            }
        }
        $posts = $posts->get();
        return view('admin.posts.index', compact('posts','categories','user',$posts,$categories,$user));
    }

    public function create()
    {
        if(Gate::denies('post_create')){
            return response()->view('admin.error.403');
        }
        $users = User::all()->pluck('name', 'id');
        //->prepend(trans('global.pleaseSelect'), '')
        $categories = Category::all()->pluck('name', 'id');
        return view('admin.posts.create', compact('users', 'categories'));
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        $post->categories()->sync($request->input('categories', []));
        // $user = User::all();
        $post->status = 'Draft';
        // $user = Auth::user();
        // $post->user_id = $user->id;
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,10).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $post->image = $new_image;
            $post->save();
            return Redirect()->back();
        }else{
            return Redirect()->back();
        }

        $post->save();
        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        if(Gate::denies('post_edit')){
            return response()->view('admin.error.403');
        }
        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $categories = Category::all()->pluck('name', 'id');
        $post->load('user', 'categories');
        return view('admin.posts.edit', compact('users', 'categories', 'post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        $post->categories()->sync($request->input('categories', []));

        $post->status = 'Draft';

        $get_image = $request->file('image');
        if ($get_image) {
            $post_image_old = $post->image;
            $path = 'public/uploads/post/'.$post_image_old;
            // unlink($path);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image.rand(0, 10).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post', $new_image);
            $post->image = $new_image;
        }
        $post->save();

        return redirect()->route('admin.posts.index');
    }

    public function show(Post $post)
    {
        if(Gate::denies('post_show')){
            return response()->view('admin.error.403');
        }
        $post->load('user', 'categories');
        return view('admin.posts.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        if(Gate::denies('post_delete')){
            return response()->view('admin.error.403');
        }
        
        $image = $post->image;
        if($image){
            $path = 'public/uploads/post/'.$image;
            unlink($path);
        }

        $post->delete();
        return back();
    }

    public function massDestroy(MassDestroyPostRequest $request)
    {
        Post::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function approve(Request $request){
        $user = User::orderBy('id')->get();
        $categories = Category::orderBy('id')->get();
        $posts = Post::with(['user', 'categories']);
        $post = Post::where('id', $request['id'])->first();
        // $post = Post::find($request['id']);
        $post->status = 'Publish';
        $post->save();
        $posts = $posts->get();
        return view('admin.posts.index', compact('user','categories','posts', $user, $categories, $posts));
    }
    public function request(Request $request){
        $post = Post::where('id', $request['id'])->first();
        $post->status = 'Pending';
        $post->save();
        return view('admin.posts.index');
    }

    public function showpostdetail(request $request, $slug)
    {
        $link_comment = $request->url();
        $post = Post::where('slug', '=', $slug)->where('status', '=', 'Publish')->firstOrFail();
        foreach ($post->categories as $value) {
            $category = $value;
            $category_id = $value->id;
            $parent_id= $value->parent_id;
        }
        $categories = Category::all();
        $similar = Post::with('categories')->where('status', '=', 'Publish')->where('id',$category_id)->get();
        return view('layouts.template.postdetail', compact('post','category','categories','similar',$post,$category,$categories,$similar))
        ->with('link_comment',$link_comment);

    }

    
}