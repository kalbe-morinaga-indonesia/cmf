<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignPermissionController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('back.role-and-permission.assign-permissions.index', compact(
            'roles',
            'permissions'
        ));
    }

    public function store(Request $request){
        $role = Role::find($request->role);
        $role->givePermissionTo($request->permission);

        return back()
            ->with('message',"Permission berhasil diberikan kepada role $role->name");
    }

    public function sync(Role $role)
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('back.role-and-permission.assign-permissions.sync', compact(
            'role',
            'roles',
            'permissions'
        ));
    }

    public function update(Role $role, Request $request)
    {
        $role->syncPermissions($request->permission);
        return redirect()
            ->route('assign-permissions.index')
            ->with('message',"Permission berhasil di synchronize");
    }
}
