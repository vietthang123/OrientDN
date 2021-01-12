<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(Gate::denies('category_access')){
            return response()->view('admin.error.403');
        }
        $categories = Category::with(['parent'])->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        if(Gate::denies('category_create')){
            return response()->view('admin.error.403');
        }
        $parents = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.categories.create', compact('parents'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        if(Gate::denies('category_edit')){
            return response()->view('admin.error.403');
        }
        $parents = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $category->load('parent');
        return view('admin.categories.edit', compact('parents', 'category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
        if(Gate::denies('category_show')){
            return response()->view('admin.error.403');
        }
        $category->load('parent', 'parentCategories');
        return view('admin.categories.show', compact('category'));
    }

    public function destroy(Category $category)
    {
        if(Gate::denies('category_delete')){
            return response()->view('admin.error.403');
        }
        $category->delete();
        return back();
    }

    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Category::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function showpost(Request $request, $name){
        $link_comment = $request->url();
        $categories = Category::all();
        $category = Category::where('slug', '=', $name)->first();
        $posts = Post::where('status', '=', 'Publish')->get();
        $parent_id = Category::where('slug', $name)->first()->id;
        return view('layouts.template.post', compact('category', 'categories', 'parent_id','posts', $category, $categories, $parent_id, $posts))
        ->with('link_comment',$link_comment);
    }
 
}