<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserAlertRequest;
use App\Http\Requests\StoreUserAlertRequest;
use App\Models\User;
use App\Models\UserAlert;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAlertsController extends Controller
{
    public function index()
    {
        if(Gate::denies('user_alert_access')){
            return response()->view('admin.error.403');
        }
        $userAlerts = UserAlert::with(['users'])->get();
        return view('admin.userAlerts.index', compact('userAlerts'));
    }

    public function create()
    {
        if(Gate::denies('user_alert_create')){
            return response()->view('admin.error.403');
        }
        $users = User::all()->pluck('name', 'id');
        return view('admin.userAlerts.create', compact('users'));
    }

    public function store(StoreUserAlertRequest $request)
    {
        $userAlert = UserAlert::create($request->all());
        $userAlert->users()->sync($request->input('users', []));
        return redirect()->route('admin.user-alerts.index');
    }

    public function show(UserAlert $userAlert)
    {
        if(Gate::denies('user_alert_show')){
            return response()->view('admin.error.403');
        }
        $userAlert->load('users');
        return view('admin.userAlerts.show', compact('userAlert'));
    }

    public function destroy(UserAlert $userAlert)
    {
        if(Gate::denies('user_alert_delete')){
            return response()->view('admin.error.403');
        }
        $userAlert->delete();
        return back();
    }

    public function massDestroy(MassDestroyUserAlertRequest $request)
    {
        UserAlert::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function read(Request $request)
    {
        $alerts = Auth::user()->userUserAlerts()->where('read', false)->get();

        foreach ($alerts as $alert) {
            $pivot       = $alert->pivot;
            $pivot->read = true;
            $pivot->save();
        }
    }
}