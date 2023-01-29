<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('back.role-and-permission.roles.index',compact(
            'roles'
        ));
    }

    public function store(RoleRequest $request)
    {
        Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web'
        ]);

        return back()
            ->with('message','Role berhasil ditambahkan');
    }

    public function edit(Role $role)
    {
        return view('back.role-and-permission.roles.edit', compact(
            'role'
        ));
    }

    public function update(Role $role, RoleRequest $request)
    {
        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? ''
        ]);

        return redirect()
            ->route('roles.index')
            ->with('message','Role berhasil diperbaharui');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()
            ->route('roles.index')
            ->with('message','Role berhasil dihapus');
    }
}
