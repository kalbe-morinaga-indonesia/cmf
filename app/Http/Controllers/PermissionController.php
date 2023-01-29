<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();
        return view('back.role-and-permission.permissions.index',compact(
            'permissions'
        ));
    }

    public function store(PermissionRequest $request)
    {
        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web'
        ]);

        return back()
            ->with('message','Permission berhasil ditambahkan');
    }

    public function edit(Permission $permission)
    {
        return view('back.role-and-permission.permissions.edit', compact(
            'permission'
        ));
    }

    public function update(Permission $permission, PermissionRequest $request)
    {
        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? ''
        ]);

        return redirect()
            ->route('permissions.index')
            ->with('message','Permission berhasil diperbaharui');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()
            ->route('permissions.index')
            ->with('message','Permission berhasil dihapus');
    }
}
