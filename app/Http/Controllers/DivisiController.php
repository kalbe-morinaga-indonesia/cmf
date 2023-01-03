<?php

namespace App\Http\Controllers;

use App\Http\Requests\DivisiRequest;
use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        return view('back.master.divisi.index',[
            'divisis' => Divisi::get()
        ]);
    }

    public function store(DivisiRequest $request)
    {
        Divisi::create([
            'txtIdDivisi' => $request->txtIdDivisi,
            'txtNamaDivisi' => $request->txtNamaDivisi
        ]);

        return redirect()->back()
        ->with("messages","Data Divisi {$request->txtNamaDivisi} berhasil ditambahkan");
    }

    public function edit(Divisi $divisi)
    {
        return view('back.master.divisi.edit',[
            'divisi' => $divisi
        ]);
    }

    public function update(DivisiRequest $request, Divisi $divisi)
    {
        Divisi::where('id',$divisi->id)->update([
            'txtIdDivisi' => $request->txtIdDivisi,
            'txtNamaDivisi' => $request->txtNamaDivisi
        ]);

        return redirect()->route('divisi.index')
        ->with("messages","Data Divisi {$request->txtNamaDivisi} berhasil diubah");
    }

    public function destroy(Divisi $divisi)
    {
        $divisi->delete();
        return redirect()->route('divisi.index')
        ->with("messages","Data Divisi {$divisi->txtNamaDivisi} berhasil dihapus");
    }
}
