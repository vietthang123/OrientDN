<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function error_page()
    {
        return view('layouts.template.404');
    }

    public function index()
    {
        return view('layouts.template.content');
    }

    public function show(Request $request)
    {
        $link_comment = $request->url();
        $newsposts = Post::where('status', '=', 'Publish')->orderByDesc('id')->take(3)->get(); //show new post
        $categories = Category::where('parent_id', null)->get();
        // dd(json_decode($categories));
        return view('layouts.template.content', compact('newsposts', 'categories', $newsposts, $categories))
            ->with('link_comment', $link_comment);
    }

    public function contact(Request $request)
    {
        $link_comment = $request->url();
        return view('layouts.template.contact')->with('link_comment', $link_comment);
    }
}
