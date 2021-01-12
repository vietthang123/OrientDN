<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index()
    {
        if(Gate::denies('user_access')){
            return response()->view('admin.error.403');
        }
        $users = User::with(['roles'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if(Gate::denies('user_create')){
            return response()->view('admin.error.403');
        }
        $roles = Role::all()->pluck('title', 'id');
        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        if(Gate::denies('user_edit')){
            return response()->view('admin.error.403');
        }
        $roles = Role::all()->pluck('title', 'id');
        $user->load('roles');
        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        if(Gate::denies('user_show')){
            return response()->view('admin.error.403');
        }
        $user->load('roles', 'userPosts', 'userUserAlerts');
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if(Gate::denies('user_delete')){
            return response()->view('admin.error.403');
        }
        $user->delete();
        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}