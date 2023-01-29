<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->has('roles')->get();
        $roles = Role::get();
        return view('back.role-and-permission.assign-users.index', compact(
            'roles',
            'users'
        ));
    }

    public function store(Request $request){
        $user = User::where('email', $request->email)->firstOrFail();
        $user->assignRole($request->roles);

        return back()
            ->with('message',"Role berhasil diberikan kepada user $user->email");
    }

    public function sync(User $user)
    {
        $roles = Role::get();
        $users = User::get();
        return view('back.role-and-permission.assign-users.sync', compact(
            'roles',
            'users',
            'user'
        ));
    }

    public function update(User $user, Request $request)
    {
        $user->syncRoles($request->roles);
        return redirect()
            ->route('assign-users.index')
            ->with('message',"Role berhasil di synchronize");
    }
}
