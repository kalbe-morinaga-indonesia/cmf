<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Models\Divisi;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('back.master.department.index',[
            'divisis' => Divisi::get(),
            'departments' => Department::with('divisi')->get()
        ]);
    }

    public function store(DepartmentRequest $request)
    {
        Department::create([
            'txtIdDept' => $request->txtIdDept,
            'divisi_id' => $request->divisi_id,
            'txtNamaDept' => $request->txtNamaDept
        ]);

        return redirect()->back()
        ->with("message","Data department {$request->txtNamaDept} berhasil ditambahkan");
    }

    public function edit(Department $department)
    {
        return view('back.master.department.edit',[
            'divisis' => Divisi::get(),
            'department' => $department
        ]);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update([
            'txtIdDept' => $request->txtIdDept,
            'divisi_id' => $request->divisi_id,
            'txtNamaDept' => $request->txtNamaDept
        ]);
        return redirect()->route('department.index')
        ->with("message","Data department {$request->txtNamaDept} berhasil diubah");
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('department.index')
        ->with("message","Data department {$department->txtNamaDept} berhasil dihapus");
    }
}
