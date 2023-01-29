<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubdepartmentRequest;
use App\Models\Department;
use App\Models\Subdepartment;
use Illuminate\Http\Request;

class SubdepartmentController extends Controller
{
    public function index()
    {
        return view('back.master.subdepartment.index',[
            'departments' => Department::get(),
            'subdepartments' => Subdepartment::with('department')->get()
        ]);
    }

    public function store(SubdepartmentRequest $request)
    {
        Subdepartment::create([
            'txtIdSubDept' => $request->txtIdSubDept,
            'txtNamaSubDept' => $request->txtNamaSubDept,
            'department_id' => $request->department_id,
        ]);

        return redirect()->back()
        ->with("message","Data subdepartment {$request->txtNamaSubDept} berhasil ditambahkan");
    }

    public function edit(Subdepartment $subdepartment)
    {
        return view('back.master.subdepartment.edit',[
            'departments' => Department::get(),
            'subdepartment' => $subdepartment
        ]);
    }

    public function update(SubdepartmentRequest $request, Subdepartment $subdepartment)
    {
        $subdepartment->update([
            'txtIdSubDept' => $request->txtIdSubDept,
            'txtNamaSubDept' => $request->txtNamaSubDept,
            'department_id' => $request->department_id,
        ]);
        return redirect()->route('subdepartment.index')
        ->with("message","Data subdepartment {$request->txtNamaSubDept} berhasil diubah");
    }

    public function destroy(Subdepartment $subdepartment)
    {
        $subdepartment->delete();
        return redirect()->route('subdepartment.index')
        ->with("message","Data subdepartment {$subdepartment->txtNamaDept} berhasil dihapus");
    }
}
