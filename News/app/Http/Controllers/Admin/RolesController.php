<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    public function index()
    {
        if(Gate::denies('role_access')){
            return response()->view('admin.error.403');
        }
        $roles = Role::with(['permissions'])->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        if(Gate::denies('role_create')){
            return response()->view('admin.error.403');
        }
        $permissions = Permission::all()->pluck('title', 'id');
        // dd($permissions);
        return view('admin.roles.create', compact('permissions'))->with('message', 'Create role successfully!');
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        if(Gate::denies('role_edit')){
            return response()->view('admin.error.403');
        }
        $permissions = Permission::all()->pluck('title', 'id');
        // dd($permissions);
        $role->load('permissions');
        // dd($role)->with('permissions');
        return view('admin.roles.edit', compact('permissions', 'role'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()->route('admin.roles.index')->with('message', 'Update role successfully!');
    }

    public function show(Role $role)
    {
        if(Gate::denies('role_show')){
            return response()->view('admin.error.403');
        }
        $role->load('permissions');
        return view('admin.roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
        if(Gate::denies('role_delete')){
            return response()->view('admin.error.403');
        }
        $role->delete();
        return back()->with('message', 'Delete role successfully!');
    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT)->with('message', 'Delete role successfully!');
    }
}