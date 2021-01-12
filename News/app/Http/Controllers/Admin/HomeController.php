<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {   
        $posts = Post::count();
        $categories = Category::count();
        $users = User::count();
        $roles = Role::count();
        return view('home',compact('posts','categories','users','roles',$posts,$categories,$users,$roles));
    }
}
