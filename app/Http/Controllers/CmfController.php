<?php

namespace App\Http\Controllers;

use App\Models\Cmf;
use App\Models\Department;
use App\Models\Risk;
use App\Models\Subdepartment;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class CmfController extends Controller
{

    public function index()
    {
        $cmfs = Cmf::get();
        return view('back.cmf.index', compact(
            'cmfs'
        ));
    }

    public function create()
    {
        $departments = Department::get();
        $department = auth()->user()->department->txtNamaDept;
        $subdepartments = Subdepartment::get();

        // No CMF
        $today = Carbon::now();
        $jumlah = CMF::whereYear('created_at', $today)->count('id');
        $no_cmf = sprintf("%04s", abs( $jumlah+1))."/CMF/" . $today->month . "/" . $today->year;

        return view('back.cmf.create', compact(
            'department',
            'departments',
            'subdepartments',
            'no_cmf'
        ));
    }

    public function store(Request $request)
    {
        $cmf = Cmf::create([
            'no_cmf' => $request['no_cmf'],
            'judul_perubahan' => $request['judul_perubahan'],
            'perubahan' => $request['perubahan'],
            'tanggal' => $request['tanggal'],
            'jenis_perubahan' => $request['jenis_perubahan'],
            'target_implementasi' => $request['target_implementasi'],
            'tipe_perubahan' => $request['tipe_perubahan'],
            'alasan_perubahan' => $request['alasan_perubahan'],
            'dampak_terhadap_perubahan' => $request['dampak_terhadap_perubahan'],
            'deskripsi_perubahan' => $request['deskripsi_perubahan'],
            'department_id' => auth()->user()->department_id,
            'subdepartment_id' => auth()->user()->subdepartment_id,
            'inserted_by' => auth()->user()->name,
            'updated_by' => auth()->user()->name,
        ]);

        foreach ($request->risk as $key => $value){
            $risk = new Risk();
            $risk->qcdsme = $value['qcdsme'];
            $risk->resiko = $value['resiko'];
            $risk->rencana_mitigasi = $value['rencana_mitigasi'];
            $risk->rica = $value['rica'];
            $risk->pic = $value['pic'];
            $risk->deadline = $value['deadline'];
            $risk->level_risk = $value['level_risk'];
            $risk->status = $value['status'];

            $cmf->risks()->save($risk);
        }

        $area_terkait = Subdepartment::find($request['area_terkait']);
        $cmf->subdepartments()->sync($area_terkait);

        $konfirmasi_department_area_terkait = Department::find($request['konfirmasi_department_area_terkait']);
        $cmf->departments()->sync($konfirmasi_department_area_terkait);

        return "Oke";
    }

    public function detail($slug)
    {
        $cmf = Cmf::where('slug', $slug)->firstOrFail();
        return view('back.cmf.detail', compact(
            'cmf'
        ));
    }
}
