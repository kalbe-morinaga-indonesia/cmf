<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Cmf;
use App\Models\Department;
use App\Models\Evaluation;
use App\Models\Review;
use App\Models\Risk;
use App\Models\Signature;
use App\Models\Subdepartment;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\View;

class CmfController extends Controller
{

    public function index()
    {
        $cmfs = Cmf::where('user_id', auth()->user()->id)->get();
        $cmfs_all = CMF::get();
        return view('back.cmf.index', compact(
            'cmfs',
            'cmfs_all'
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
        $no_cmf = sprintf("%04s", abs( $jumlah+1))."/CMF/" . $this->numberToRomanRepresentation($today->month) . "/" . $today->year;
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
            'user_id' => auth()->user()->id,
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

        return redirect()
            ->route('cmf.index')
            ->with('message','Request CMF Berhasil dibuat');
    }

    public function review($slug)
    {
        $cmf = Cmf::where('slug', $slug)->firstOrFail();

        $depthead_area_terkait = CMF::withCount('departments')->where('slug', $slug)->first();

        $check_signature = Signature::where([
            ['cmf_id', $cmf->id],
            ['user_id', auth()->user()->id],
        ])->first();

        $check_signature_step_1 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 1],
        ])->first();

        $check_signature_step_2 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 2],
        ])->get();
        $check_signature_step_2_count = $check_signature_step_2->count();

        $check_signature_step_5 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 5],
        ])->first();

        $check_signature_step_6 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 6],
        ])->first();

        $check_signature_step_7 = Signature::where([
            ['cmf_id', $cmf->id],
            ['user_id', auth()->user()->id],
            ['step', 7],
        ])->first();

        $check_signature_step_7_get = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 7],
        ])->get();

        $check_signature_step_7_signature_0 = Signature::where([
            ['cmf_id', $cmf->id],
            ['is_signature',0],
            ['step',7]
        ])->get();

        $check_signature_step_7_signature_0_count = $check_signature_step_7_signature_0->count();

        $signature_reviews = $check_signature_step_2->each(function ($val, $key){
            Review::whereIn('signature_id', $val)->get();
        });

        $signature_evaluations = $check_signature_step_7_get->each(function ($val, $key){
            Evaluation::whereIn('signature_id', $val)->get();
        });

        $check_signature_step_8 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 8],
        ])->first();

        $check_signature_step_9 = Signature::where([
            ['cmf_id', $cmf->id],
            ['user_id', auth()->user()->id],
            ['step', 9],
        ])->first();

        $has_activity = Activity::where('cmf_id', $cmf->id)->first();

        return view('back.cmf.review', compact(
            'cmf',
            'check_signature_step_1',
            'depthead_area_terkait',
            'check_signature_step_2_count',
            'signature_reviews',
            'has_activity',
            'check_signature',
            'check_signature_step_5',
            'check_signature_step_6',
            'check_signature_step_7',
            'check_signature_step_7_get',
            'signature_evaluations',
            'check_signature_step_8',
            'check_signature_step_9',
            'check_signature_step_7_signature_0_count'
        ));
    }

    public function activity($slug, Request $request)
    {
        $cmf = Cmf::where('slug', $slug)->firstOrFail();
        $user = User::find(auth()->user()->id)->first();
        if($request['btn_review'] == 'review'){
            $validated = $request->validate([
                'tanggal_instalasi' => 'required|date',
                'tanggal_trial' => 'required|date',
                'tanggal_implementasi' => 'required|date'
            ]);

            Activity::create([
                'cmf_id' => $cmf->id,
                'tanggal_instalasi' => $validated['tanggal_instalasi'],
                'tanggal_trial' => $validated['tanggal_trial'],
                'tanggal_implementasi' => $validated['tanggal_implementasi']
            ]);

            return redirect()
                ->route('cmf.index')
                ->with('message','Request Perubahan CMF Berhasil dikirim');
        }elseif($request['btn_review'] == 'setuju'){
            if(auth()->user()->hasRole('depthead pic')){
                DB::transaction(function () use($cmf, $user, $request){
                    if($request->hasFile('signature')){
                        $slug = auth()->user()->name;
                        $extFileSignature = $request->signature->getClientOriginalExtension();
                        $nameFileSignature = $slug.'-'.time()."-signature.".$extFileSignature;
                        $request->signature->storeAs('public/uploads/signature/',$nameFileSignature);
                        $user->update([
                            'signature' => $nameFileSignature,
                        ]);
                    }

                    Signature::firstOrCreate([
                        'cmf_id' => $cmf->id,
                        'user_id' => auth()->user()->id,
                        'is_signature' => 1,
                        'step' => 6,
                        'keterangan' => 'Pengajuan Request Perubahan Disetujui Depthead PIC',
                        'catatan' => $request['catatan']
                    ]);

                    $cmf->update([
                        'status_pengajuan' => 'Pengajuan Request Perubahan Disetujui Depthead PIC',
                        'step' => 8,
                        'updated_by' => $user->name
                    ]);
                });
                return back()
                    ->with('message','Request Perubahan CMF Berhasil disetujui');
            }else{
                abort(403);
            }
        }elseif($request['btn_review'] == 'tidak_setuju'){
            if(auth()->user()->hasRole('depthead pic')){
                DB::transaction(function () use($cmf, $user, $request){
                    Signature::firstOrCreate([
                        'cmf_id' => $cmf->id,
                        'user_id' => auth()->user()->id,
                        'is_signature' => 0,
                        'step' => 6,
                        'keterangan' => 'Pengajuan Request Perubahan Tidak Disetujui Depthead PIC',
                        'catatan' => $request['catatan']
                    ]);

                    $cmf->update([
                        'status_pengajuan' => 'Pengajuan Request Perubahan Tidak Disetujui Depthead PIC',
                        'step' => 8,
                        'updated_by' => $user->name
                    ]);
                });
                return back()
                    ->with('message-error','Request Perubahan CMF Tidak disetujui');
            }else{
                abort(403);
            }
        }elseif($request['btn_review'] == 'evaluasi_verifikasi'){
            if(auth()->user()->hasRole('depthead')){
                DB::transaction(function () use($cmf, $user, $request){
                    if($request->hasFile('signature')){
                        $slug = auth()->user()->name;
                        $extFileSignature = $request->signature->getClientOriginalExtension();
                        $nameFileSignature = $slug.'-'.time()."-signature.".$extFileSignature;
                        $request->signature->storeAs('public/uploads/signature/',$nameFileSignature);
                        $user->update([
                            'signature' => $nameFileSignature,
                        ]);
                    }

                    $signature = Signature::firstOrCreate([
                        'cmf_id' => $cmf->id,
                        'user_id' => auth()->user()->id,
                        'is_signature' => 1,
                        'step' => 7,
                        'keterangan' => 'Evaluasi dan Verifikasi Disetujui Depthead',
                        'catatan' => $request['catatan']
                    ]);

                    Evaluation::create([
                        'signature_id' => $signature->id,
                        'department_id' => auth()->user()->department_id,
                        'evaluasi' => $request['evaluasi']
                    ]);

                    $cmf->update([
                        'status_pengajuan' => 'Evaluasi dan Verifikasi Disetujui Depthead',
                        'step' => 8,
                        'updated_by' => $user->name
                    ]);
                });
                return back()
                    ->with('message','Evaluasi CMF berhasil diverifikasi');
            }else{
                abort(403);
            }
        }elseif($request['btn_review'] == 'evaluasi_verifikasi_tidak_setuju'){
            if(auth()->user()->hasRole('depthead')){
                DB::transaction(function () use($cmf, $user, $request){
                    $signature = Signature::firstOrCreate([
                        'cmf_id' => $cmf->id,
                        'user_id' => auth()->user()->id,
                        'is_signature' => 0,
                        'step' => 7,
                        'keterangan' => 'Evaluasi dan Verifikasi TIdak Disetujui Depthead',
                        'catatan' => $request['catatan']
                    ]);

                    Evaluation::create([
                        'signature_id' => $signature->id,
                        'department_id' => auth()->user()->department_id,
                        'evaluasi' => $request['evaluasi']
                    ]);

                    $cmf->update([
                        'status_pengajuan' => 'Evaluasi dan Verifikasi Tidak Disetujui Depthead',
                        'step' => 8,
                        'updated_by' => $user->name
                    ]);
                });
                return back()
                    ->with('message-error','Evaluasi CMF Tidak Disetujui');
            }else{
                abort(403);
            }
        }elseif($request['btn_review'] == 'verifikasi'){
            if(auth()->user()->hasRole('mr & food safety team')){
                DB::transaction(function () use($cmf, $user, $request){
                    Signature::firstOrCreate([
                        'cmf_id' => $cmf->id,
                        'user_id' => auth()->user()->id,
                        'is_signature' => 1,
                        'step' => 8,
                        'keterangan' => 'Verifikasi Disetujui MR & Food Safety Team',
                        'catatan' => $request['catatan']
                    ]);

                    $cmf->update([
                        'status_pengajuan' => 'Verifikasi Disetujui MR & Food Safety Team',
                        'step' => 9,
                        'updated_by' => $user->name
                    ]);
                });
                return back()
                    ->with('message','CMF berhasil diverifikasi');
            }if(auth()->user()->hasRole('document control')){
                DB::transaction(function () use($cmf, $user, $request){
                    Signature::firstOrCreate([
                        'cmf_id' => $cmf->id,
                        'user_id' => auth()->user()->id,
                        'is_signature' => 1,
                        'step' => 9,
                        'keterangan' => 'Verifikasi Disetujui Document Control',
                        'catatan' => $request['catatan']
                    ]);

                    $cmf->update([
                        'status_pengajuan' => 'Verifikasi Disetujui Document Control',
                        'step' => 10,
                        'updated_by' => $user->name
                    ]);
                });
                return back()
                    ->with('print','CMF berhasil diverifikasi');
            }else{
                abort(403);
            }
        }elseif($request['btn_review'] == 'verifikasi_tidak_setuju'){
            if(auth()->user()->hasRole('mr & food safety team')){
                DB::transaction(function () use($cmf, $user, $request){
                    Signature::firstOrCreate([
                        'cmf_id' => $cmf->id,
                        'user_id' => auth()->user()->id,
                        'is_signature' => 0,
                        'step' => 8,
                        'keterangan' => 'Verifikasi Tidak Disetujui MR & Food Safety Team',
                        'catatan' => $request['catatan']
                    ]);

                    $cmf->update([
                        'status_pengajuan' => 'Verifikasi Tidak Disetujui MR & Food Safety Team',
                        'step' => 9,
                        'updated_by' => $user->name
                    ]);
                });
                return back()
                    ->with('message-error','CMF tidak diverifikasi');
            }if(auth()->user()->hasRole('document control')){
                DB::transaction(function () use($cmf, $user, $request){
                    Signature::firstOrCreate([
                        'cmf_id' => $cmf->id,
                        'user_id' => auth()->user()->id,
                        'is_signature' => 0,
                        'step' => 9,
                        'keterangan' => 'Verifikasi Tidak Disetujui Document Control',
                        'catatan' => $request['catatan']
                    ]);

                    $cmf->update([
                        'status_pengajuan' => 'Verifikasi Tidak Disetujui Document Control',
                        'step' => 10,
                        'updated_by' => $user->name
                    ]);
                });
                return back()
                    ->with('message-error','CMF tidak diverifikasi');
            }else{
                abort(403);
            }
        }
    }

    public function detail($slug)
    {
        $cmf = Cmf::where('slug', $slug)->firstOrFail();
        $depthead_area_terkait = CMF::withCount('departments')->where('slug', $slug)->first();

        $check_signature = Signature::where([
            ['cmf_id', $cmf->id],
            ['user_id', auth()->user()->id],
        ])->first();

        $check_signature_step_1 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 1],
        ])->first();

        $check_signature_step_2_check = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 2],
            ['user_id', auth()->user()->id]
        ])->first();

        $check_signature_step_2 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 2],
        ])->get();
        $check_signature_step_2_count = $check_signature_step_2->count();

        $check_signature_step_2_has_signature = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 2],
            ['is_signature', 0]
        ])->get();
        $check_signature_step_2_has_signature_count = $check_signature_step_2_has_signature->count();


        $check_signature_step_3 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 3],
        ])->first();

        $check_signature_step_4 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 4],
        ])->first();

        $check_signature_step_5 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 5],
        ])->first();

        $check_signature_step_6 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 6],
        ])->first();

        $signature_reviews = $check_signature_step_2->each(function ($val, $key){
            Review::whereIn('signature_id', $val)->get();
        });

        $check_signature_step_7_signature_0 = Signature::where([
            ['cmf_id', $cmf->id],
            ['is_signature',0],
            ['step',7]
        ])->get();

        $check_signature_step_7_signature_0_count = $check_signature_step_7_signature_0->count();

        $check_signature_step_8 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 8],
        ])->first();

        $check_signature_step_9 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step', 9],
        ])->first();

        return view('back.cmf.detail', compact(
            'cmf',
            'check_signature',
            'check_signature_step_1',
            'depthead_area_terkait',
            'check_signature_step_2',
            'check_signature_step_2_check',
            'check_signature_step_2_count',
            'check_signature_step_3',
            'signature_reviews',
            'check_signature_step_4',
            'check_signature_step_2_has_signature_count',
            'check_signature_step_5',
            'check_signature_step_6',
            'check_signature_step_7_signature_0_count',
            'check_signature_step_8',
            'check_signature_step_9'
        ));
    }

    public function status($slug)
    {
        $cmf = Cmf::where('slug', $slug)->firstOrFail();
        $histories = Signature::where('cmf_id', $cmf->id)->get();
        $check_signature_step_1 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',1]
        ])->first();
        $check_signature_depthead = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',2]
        ])->get();
        $check_signature_step_3 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',3]
        ])->first();
        $check_signature_step_4 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',4]
        ])->first();
        $check_signature_step_5 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',5]
        ])->first();
        $check_signature_step_6 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',6]
        ])->first();
        $check_signature_step_7 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',7]
        ])->get();
        $check_signature_step_8 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',8]
        ])->first();
        $check_signature_step_9 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',9]
        ])->first();

        return view('back.cmf.status', compact(
            'cmf',
            'check_signature_step_1',
            'check_signature_depthead',
            'check_signature_step_3',
            'check_signature_step_4',
            'check_signature_step_5',
            'check_signature_step_6',
            'check_signature_step_7',
            'check_signature_step_8',
            'check_signature_step_9',
            'histories'
        ));
    }

    public function signature($slug, Request $request)
    {
        $cmf = Cmf::where('slug', $slug)->firstOrFail();
        $user = User::find(auth()->user()->id)->first();
        if(auth()->user()->hasRole('depthead pic')){
            DB::transaction(function () use($cmf, $user, $request){
                if($request->hasFile('signature')){
                    $slug = auth()->user()->name;
                    $extFileSignature = $request->signature->getClientOriginalExtension();
                    $nameFileSignature = $slug.'-'.time()."-signature.".$extFileSignature;
                    $request->signature->storeAs('public/uploads/signature/',$nameFileSignature);
                    $user->update([
                        'signature' => $nameFileSignature,
                    ]);
                }

                Signature::firstOrCreate([
                    'cmf_id' => $cmf->id,
                    'user_id' => auth()->user()->id,
                    'is_signature' => 1,
                    'step' => 1,
                    'keterangan' => 'Pengajuan Request Perubahan Disetujui Depthead PIC',
                    'catatan' => $request['catatan']
                ]);

                $cmf->update([
                    'status_pengajuan' => 'Pengajuan Request Perubahan Disetujui Depthead PIC',
                    'step' => 3,
                    'updated_by' => $user->name
                ]);
            });
            return back()
                ->with('message','Request Perubahan CMF Berhasil disetujui');
        }elseif (auth()->user()->hasRole('depthead')){
            DB::transaction(function () use($cmf, $user, $request){
                if($request->hasFile('signature')){
                    $slug = auth()->user()->name;
                    $extFileSignature = $request->signature->getClientOriginalExtension();
                    $nameFileSignature = $slug.'-'.time()."-signature.".$extFileSignature;
                    $request->signature->storeAs('public/uploads/signature/',$nameFileSignature);
                    $user->update([
                        'signature' => $nameFileSignature,
                    ]);
                }

                $signature = Signature::firstOrCreate([
                    'cmf_id' => $cmf->id,
                    'user_id' => auth()->user()->id,
                    'is_signature' => 1,
                    'step' => 2,
                    'keterangan' => "Menyetujui Request Review CMF Oleh Depthead Area Terkait"
                ]);

                Review::create([
                    'signature_id' => $signature->id,
                    'department_id' => auth()->user()->department_id,
                    'review' => $request['review']
                ]);

                $cmf->update([
                    'status_pengajuan' => "Menyetujui Request Review CMF Oleh Depthead Area Terkait",
                    'step' => 4,
                    'updated_by' => $user->name
                ]);
            });
            return back()
                ->with('message','Request Review CMF Berhasil disetujui');
        }elseif (auth()->user()->hasRole('svp system')){
            DB::transaction(function () use($cmf, $user, $request){
                Signature::firstOrCreate([
                    'cmf_id' => $cmf->id,
                    'user_id' => auth()->user()->id,
                    'is_signature' => 1,
                    'step' => 3,
                    'keterangan' => "Menyetujui Request Review CMF Oleh SVP System"
                ]);
                $cmf->update([
                    'status_pengajuan' => "Menyetujui Request Review CMF Oleh SVP System",
                    'step' => 5,
                    'updated_by' => $user->name
                ]);
            });
            return back()
                ->with('message','Request Review CMF Berhasil disetujui');
        }elseif (auth()->user()->hasRole('mnf')){
            DB::transaction(function () use($cmf, $user, $request){
                Signature::firstOrCreate([
                    'cmf_id' => $cmf->id,
                    'user_id' => auth()->user()->id,
                    'is_signature' => 1,
                    'step' => 4,
                    'keterangan' => "Menyetujui Request Review CMF Oleh MNF"
                ]);
                $cmf->update([
                    'status_pengajuan' => "Menyetujui Request Review CMF Oleh MNF",
                    'step' => 6,
                    'updated_by' => $user->name
                ]);
            });
            return back()
                ->with('message','Request Review CMF Berhasil disetujui');
        }elseif (auth()->user()->hasRole('mr & food safety team')){
            DB::transaction(function () use($cmf, $user, $request){
                Signature::firstOrCreate([
                    'cmf_id' => $cmf->id,
                    'user_id' => auth()->user()->id,
                    'is_signature' => 1,
                    'step' => 5,
                    'keterangan' => "Menyetujui Request Review CMF Oleh MR & Food Safety Team"
                ]);
                $cmf->update([
                    'status_pengajuan' => "Menyetujui Request Review CMF Oleh MR & Food Safety Team",
                    'step' => 7,
                    'updated_by' => $user->name
                ]);
            });
            return back()
                ->with('message','Request Review CMF Berhasil disetujui');
        }
        else{
            abort(403);
        }
    }

    public function revised($slug, Request $request)
    {
        $cmf = Cmf::where('slug', $slug)->firstOrFail();
        if(auth()->user()->hasRole('depthead pic')){
            DB::transaction(function () use($cmf, $request){
                $cmf->update([
                    'status_pengajuan' => 'Pengajuan Request Perubahan Tidak Disetujui Depthead PIC',
                    'step' => 2,
                    'updated_by' => auth()->user()->name
                ]);
                Signature::updateOrCreate([
                    'cmf_id' => $cmf->id,
                    'user_id' => auth()->user()->id,
                    'is_signature' => 0,
                    'step' => 1,
                    'keterangan' => "Request Perubahan CMF Tidak Disetujui Oleh Depthead PIC",
                    'catatan' => $request['catatan']
                ]);
            });
            return back()
                ->with('message-error','Request Perubahan CMF tidak disetujui');
        }
        elseif(auth()->user()->hasRole('depthead')){
            DB::transaction(function () use($cmf, $request){
                $cmf->update([
                    'status_pengajuan' => 'Pengajuan Request Review Tidak Disetujui Depthead Area Terkait',
                    'step' => 3,
                    'updated_by' => auth()->user()->name
                ]);

                $signature = Signature::updateOrCreate([
                    'cmf_id' => $cmf->id,
                    'user_id' => auth()->user()->id,
                    'is_signature' => 0,
                    'step' => 2,
                    'keterangan' => "Request Review CMF Tidak Disetujui Oleh Depthead Area Terkait"
                ]);

                Review::create([
                    'signature_id' => $signature->id,
                    'department_id' => auth()->user()->department_id,
                    'review' => $request['review']
                ]);

            });
            return back()
                ->with('message-error','Request Review CMF tidak disetujui');
        }
        elseif(auth()->user()->hasRole('svp system')){
            DB::transaction(function () use($cmf){
                $cmf->update([
                    'status_pengajuan' => 'Pengajuan Request Review Tidak Disetujui SVP System',
                    'step' => 4,
                    'updated_by' => auth()->user()->name
                ]);
                Signature::updateOrCreate([
                    'cmf_id' => $cmf->id,
                    'user_id' => auth()->user()->id,
                    'is_signature' => 0,
                    'step' => 3,
                    'keterangan' => "Request Review CMF Tidak Disetujui Oleh SVP System"
                ]);
            });
            return back()
                ->with('message-error','Request Review CMF tidak disetujui');
        } elseif(auth()->user()->hasRole('mnf')){
            DB::transaction(function () use($cmf){
                $cmf->update([
                    'status_pengajuan' => 'Pengajuan Request Review Tidak Disetujui MNF',
                    'step' => 5,
                    'updated_by' => auth()->user()->name
                ]);
                Signature::updateOrCreate([
                    'cmf_id' => $cmf->id,
                    'user_id' => auth()->user()->id,
                    'is_signature' => 0,
                    'step' => 4,
                    'keterangan' => "Request Review CMF Tidak Disetujui Oleh MNF"
                ]);
            });
            return back()
                ->with('message-error','Request Review CMF tidak disetujui');
        }elseif(auth()->user()->hasRole('mr & food safety team')){
            DB::transaction(function () use($cmf){
                $cmf->update([
                    'status_pengajuan' => 'Pengajuan Request Review Tidak Disetujui MR & Food Safety Team',
                    'step' => 6,
                    'updated_by' => auth()->user()->name
                ]);
                Signature::updateOrCreate([
                    'cmf_id' => $cmf->id,
                    'user_id' => auth()->user()->id,
                    'is_signature' => 0,
                    'step' => 5,
                    'keterangan' => "Request Review CMF Tidak Disetujui Oleh MR & Food Safety Team"
                ]);
            });
            return back()
                ->with('message-error','Request Review CMF tidak disetujui');
        }
        else{
            abort(403);
        }

    }

    public function print($slug)
    {
        $cmf = Cmf::where('slug', $slug)->firstOrFail();
        $check_signature_step_1 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',1]
        ])->first();
        $check_signature_step_2 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',2]
        ])->get();
        $check_signature_step_3 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',3]
        ])->first();
        $check_signature_step_4 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',4]
        ])->first();
        $check_signature_step_5 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',5]
        ])->first();
        $check_signature_step_6 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',6]
        ])->first();
        $check_signature_step_7 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',7]
        ])->get();
        $check_signature_step_8 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',8]
        ])->first();
        $check_signature_step_9 = Signature::where([
            ['cmf_id', $cmf->id],
            ['step',9]
        ])->first();

        $signature_reviews = $check_signature_step_2->each(function ($val, $key){
            Review::whereIn('signature_id', $val)->get();
        });

        $signature_evaluations = $check_signature_step_7->each(function ($val, $key){
            Review::whereIn('signature_id', $val)->get();
        });
        $pdf = Pdf::loadView('print',[
            'cmf' => $cmf,
            'check_signature_step_1' => $check_signature_step_1,
            'check_signature_step_2' => $check_signature_step_2,
            'check_signature_step_3' => $check_signature_step_3,
            'check_signature_step_4' => $check_signature_step_4,
            'check_signature_step_5' => $check_signature_step_5,
            'check_signature_step_6' => $check_signature_step_6,
            'check_signature_step_7' => $check_signature_step_7,
            'check_signature_step_8' => $check_signature_step_8,
            'check_signature_step_9' => $check_signature_step_9,
            'signature_reviews' => $signature_reviews,
            'signature_evaluations' => $signature_evaluations
        ])->setPaper('A4');
        return $pdf->stream();
    }

    public function lacak(Request $request)
    {

        $no_cmf = $request['no_cmf'];
        $cmf = Cmf::where('no_cmf', $no_cmf)->first();

        return view('back.cmf.lacak', compact(
            'cmf'
        ));
    }

    public function numberToRomanRepresentation($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}
