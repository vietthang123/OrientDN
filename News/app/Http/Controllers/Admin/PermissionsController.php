<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{
    public function index()
    {
        if(Gate::denies('permission_access')){
            return response()->view('admin.error.403');
        }
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        if(Gate::denies('permission_create')){
            return response()->view('admin.error.403');
        }
        return view('admin.permissions.create')->with('message', 'Create permission successfully!');
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create($request->all());
        return redirect()->route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        if(Gate::denies('permission_edit')){
            return response()->view('admin.error.403');
        }
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());
        return redirect()->route('admin.permissions.index')->with('message', 'Update permission successfully!');
    }

    public function show(Permission $permission)
    {
        if(Gate::denies('permission_show')){
            return response()->view('admin.error.403');
        }
        return view('admin.permissions.show', compact('permission'));
    }

    public function destroy(Permission $permission)
    {
        if(Gate::denies('permission_delete')){
            return response()->view('admin.error.403');
        }
        $permission->delete();
        return back()->with('message', 'Delete permission successfully!');
    }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT)->with('message', 'Delete permission successfully!');
    }
}