@extends('layouts.back')
@section('title','Review Perubahan CMF - CMF Online')

@section('content')
    <h4 class="fw-bold"><span class="text-muted fw-light">CMF / </span> Review Perubahan</h4>
    <a href="{{route('cmf.detail',['slug' => $cmf->slug])}}" target="_blank" class="btn btn-primary mb-4">Cek detail CMF</a>
    @if (session()->has('message'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            </div>
        </div>
    @endif
    @if (session()->has('message-error'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-danger">{{ session()->get('message-error') }}</div>
            </div>
        </div>
    @endif
    @role('depthead pic')
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card mb-4">
                <h5 class="card-header">Detail Aktivitas</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tanggal_instalasi" class="form-label">Tanggal Instalasi</label>
                                <input type="text" id="tanggal_instalasi" class="form-control" value="{{date('d M Y', strtotime($cmf->activity->tanggal_instalasi))}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tanggal_trial" class="form-label">Tanggal Trial</label>
                                <input type="text" id="tanggal_trial" class="form-control" value="{{date('d M Y', strtotime($cmf->activity->tanggal_trial))}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tanggal_implementasi" class="form-label">Tanggal Implementasi</label>
                                <input type="text" id="tanggal_implementasi" class="form-control" value="{{date('d M Y', strtotime($cmf->activity->tanggal_implementasi))}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    @role('depthead')
    <h4 class="fw-bold">Evaluasi dan Verifikasi</h4>
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card mb-4">
                <h5 class="card-header">Detail Aktivitas</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tanggal_instalasi" class="form-label">Tanggal Instalasi</label>
                                <input type="text" id="tanggal_instalasi" class="form-control" value="{{date('d M Y', strtotime($cmf->activity->tanggal_instalasi))}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tanggal_trial" class="form-label">Tanggal Trial</label>
                                <input type="text" id="tanggal_trial" class="form-control" value="{{date('d M Y', strtotime($cmf->activity->tanggal_trial))}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tanggal_implementasi" class="form-label">Tanggal Implementasi</label>
                                <input type="text" id="tanggal_implementasi" class="form-control" value="{{date('d M Y', strtotime($cmf->activity->tanggal_implementasi))}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="catatan" class="form-label">Catatan Depthead PIC</label>
                        <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control" readonly>{{$check_signature_step_6->catatan ?? "Tidak ada catatan"}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    @role('mr & food safety team')
    <h4 class="fw-bold">Evaluasi dan Verifikasi</h4>
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card mb-4">
                <h5 class="card-header">Detail Aktivitas</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tanggal_instalasi" class="form-label">Tanggal Instalasi</label>
                                <input type="text" id="tanggal_instalasi" class="form-control" value="{{date('d M Y', strtotime($cmf->activity->tanggal_instalasi))}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tanggal_trial" class="form-label">Tanggal Trial</label>
                                <input type="text" id="tanggal_trial" class="form-control" value="{{date('d M Y', strtotime($cmf->activity->tanggal_trial))}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="tanggal_implementasi" class="form-label">Tanggal Implementasi</label>
                                <input type="text" id="tanggal_implementasi" class="form-control" value="{{date('d M Y', strtotime($cmf->activity->tanggal_implementasi))}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="catatan" class="form-label">Catatan Depthead PIC</label>
                        <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control" readonly>{{$check_signature_step_6->catatan ?? "Tidak ada catatan"}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    <div class="row mb-4">
        <div class="col-lg-8">
            @if($check_signature_step_1)
                @role('mr & food safety team|document control')
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <h4 class="fw-bold">Evaluasi</h4>
                        <div class="card mb-4">
                            <h5 class="card-header bg-dark text-white">Dept Head PIC</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p class="text-center text-dark card-header">Dibuat Oleh</p>
                                        <div class="text-center">
                                            <img src="{{asset('storage/uploads/signature/'. $cmf->user->signature)}}" alt="" height="80" class="mb-2">
                                            <p class="text-dark">{{$cmf->user->name}}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="card-header text-center text-dark">Catatan Depthead PIC</p>
                                        <p>{{$check_signature_step_1->catatan ?? 'Tidak ada catatan'}}</p>
                                    </div>
                                    <div class="col-lg-3">
                                        <p class="text-center text-dark card-header">Disetujui Oleh</p>
                                        <div class="text-center">
                                            <img src="{{asset('storage/uploads/signature/'. $check_signature_step_1->user->signature)}}" alt="" height="80">
                                            <p class="text-dark">{{$check_signature_step_1->user->name}}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @foreach($signature_evaluations as $evaluation)
                            @if($evaluation->is_signature == 1)
                                <div class="card mb-4">
                                    <h5 class="card-header bg-dark text-white">Dept Head Area Terkait {{$evaluation->evaluation->department->txtNamaDept}}</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <p class="text-center text-dark card-header">Dibuat Oleh</p>
                                                <div class="text-center">
                                                    <img src="{{asset('storage/uploads/signature/'. $cmf->user->signature)}}" alt="" height="80" class="mb-2">
                                                    <p class="text-dark">{{$cmf->user->name}}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <p class="card-header text-center text-dark">Evaluasi Depthead {{$evaluation->evaluation->department->txtNamaDept}}</p>
                                                <p>{{$evaluation->evaluation->evaluasi ?? 'Tidak ada evaluasi'}}</p>
                                            </div>
                                            <div class="col-lg-3">
                                                <p class="text-center text-dark card-header">Disetujui Oleh</p>
                                                <div class="text-center">
                                                    <img src="{{asset('storage/uploads/signature/'. $evaluation->user->signature)}}" alt="" height="80">
                                                    <p class="text-dark">{{$evaluation->evaluation->signature->user->name}}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if($evaluation->is_signature == 0)
                                    <div class="card mb-4">
                                        <h5 class="card-header bg-danger text-white">Dept Head Area Terkait {{$evaluation->evaluation->department->txtNamaDept}} - Tidak Menyetujui</h5>
                                        <div class="card-body">
                                            <p class="card-header text-center text-dark">Evaluasi Depthead {{$evaluation->evaluation->department->txtNamaDept}}</p>
                                            <p>{{$evaluation->evaluation->evaluasi ?? 'Tidak ada evaluasi'}}</p>
                                        </div>
                                    </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endrole
                <div class="row mb-4">
                    <div class="col-lg-12">
                        @role('depthead|mr & food safety team|document control')
                        <h4 class="fw-bold">Review Perubahan</h4>
                        @endrole
                        @if($depthead_area_terkait->departments_count == $check_signature_step_2_count)
                            @foreach($signature_reviews as $review)
                                <div class="card mb-4">
                                    <h5 class="card-header bg-dark text-white">Dept Head Area Terkait {{$review->review->department->txtNamaDept}}</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <p class="text-center text-dark card-header">Dibuat Oleh</p>
                                                <div class="text-center">
                                                    <img src="{{asset('storage/uploads/signature/'. $cmf->user->signature)}}" alt="" height="80" class="mb-2">
                                                    <p class="text-dark">{{$cmf->user->name}}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <p class="card-header text-center text-dark">Review Depthead {{$review->review->department->txtNamaDept}}</p>
                                                <p>{{$review->review->review ?? 'Tidak ada review'}}</p>
                                            </div>
                                            <div class="col-lg-3">
                                                <p class="text-center text-dark card-header">Disetujui Oleh</p>
                                                <div class="text-center">
                                                    <img src="{{asset('storage/uploads/signature/'. $review->user->signature)}}" alt="" height="80">
                                                    <p class="text-dark">{{$review->review->signature->user->name}}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="col-lg-4 sticky-top">
            @role('pic')
            <div class="card mb-4">
                <h5 class="card-header">Detail Aktivitas</h5>
                <div class="card-body">
                    @if($has_activity)
                        <div class="alert alert-danger">Anda sudah mengirimkan review perubahan</div>
                    @else
                        <form action="{{route('cmf.activity',['slug' => $cmf->slug])}}" method="post">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="tanggal_instalasi" class="form-label">Tanggal Instalasi</label>
                                <input type="date" name="tanggal_instalasi" id="tanggal_instalasi" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                <label for="tanggal_trial" class="form-label">Tanggal Trial</label>
                                <input type="date" name="tanggal_trial" id="tanggal_trial" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                <label for="tanggal_implementasi" class="form-label">Tanggal Implementasi</label>
                                <input type="date" name="tanggal_implementasi" id="tanggal_implementasi" class="form-control">
                            </div>
                            <div class="text-end">
                                <button type="submit" name="btn_review" value="review" class="btn btn-dark"><i class="bx bx-send me-2"></i>Review</button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
            @endrole
            @role('depthead pic')
            <div class="card mb-4">
                <h5 class="card-header">Keputusan Perubahan</h5>
                <hr class="my-0">
                <div class="card-body">
                    @if($cmf->activity)
                        @if($check_signature_step_6 != null)
                            @if($check_signature_step_6->is_signature == 1)
                                <div class="text-center mb-4">
                                    <img src="{{asset('storage/uploads/signature/'. $check_signature->user->signature)}}" alt="" height="80">
                                </div>
                                <div class="alert alert-success">
                                    <i class="bx bx-check-circle me-1"></i> Pengajuan Request Perubahan CMF sudah ditanda tangan dan sudah disetujui
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#noteModalPerubahan"><i class="bx bx-note me-2"></i>Cek Catatan</button>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    Pengajuan Request Perubahan CMF tidak disetujui
                                </div>
                            @endif
                        @else
                            <div class="d-block d-grid gap-2">
                                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#requestModalPerubahan">Setuju</button>
                                <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#dontRequestModalPerubahan">Tidak Setuju</button>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-danger">
                            PIC belum mengisi detail aktivitas
                        </div>
                    @endif
                </div>
            </div>
            @endrole
            @role('depthead')
            <div class="card mb-4">
                <h5 class="card-header">Verifikasi</h5>
                <hr class="my-0">
                <div class="card-body">
                    @if($cmf->activity)
                        @if($check_signature_step_6 != null)
                            @if($check_signature_step_6->is_signature == 1)
                                @if($check_signature_step_7 != null)
                                    @if($check_signature_step_7->is_signature == 1)
                                        <div class="text-center mb-4">
                                            <img src="{{asset('storage/uploads/signature/'. $check_signature->user->signature)}}" alt="" height="80">
                                        </div>
                                        <div class="alert alert-success">
                                            <i class="bx bx-check-circle me-1"></i> Request perubahan CMF berhasil di evaluasi dan verifikasi
                                        </div>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#reviewModalEvaluasiVerifikasi"><i class="bx bx-note me-2"></i>Cek Evaluasi</button>
                                        </div>
                                    @else
                                        <div class="alert alert-danger">
                                            Evaluasi & Verifikasi Tidak Disetujui
                                        </div>
                                    @endif
                                @else
                                    <div class="d-block d-grid gap-2">
                                        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#requestModalEvaluasiVerifikasi">Setuju</button>
                                        <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#dontRequestModalEvaluasiVerifikasi">Tidak Setuju</button>
                                    </div>
                                @endif
                            @else
                                <div class="alert alert-danger">Depthead PIC tidak menyetujui</div>
                            @endif
                        @endif
                    @else
                        <div class="alert alert-danger">
                            PIC belum mengisi detail aktivitas
                        </div>
                    @endif
                </div>
            </div>
            @endrole
            @role('mr & food safety team')
            <div class="card mb-4">
                <h5 class="card-header">Verifikasi</h5>
                <hr class="my-0">
                <div class="card-body">
                    @if($cmf->activity)
                        @if($check_signature_step_6 != null)
                            @if($check_signature_step_6->is_signature == 0)
                                <div class="alert alert-danger">Depthead PIC tidak menyetujui</div>
                            @else
                                @if($check_signature_step_7_signature_0_count != null)
                                    @if($check_signature_step_7_signature_0_count > 0)
                                        <div class="alert alert-danger">Salah satu depthead tidak menyetujui</div>
                                    @endif
                                @else
                                    @if($check_signature_step_8 != null)
                                        @if($check_signature_step_8->is_signature == 1)
                                            <div class="text-center mb-4">
                                                <img src="{{asset('storage/uploads/signature/'. $check_signature->user->signature)}}" alt="" height="80">
                                            </div>
                                            <div class="alert alert-success">
                                                <i class="bx bx-check-circle me-1"></i> Request perubahan CMF berhasil di verifikasi
                                            </div>
                                        @else
                                            <div class="alert alert-danger">
                                                <i class="bx bx-check-circle me-1"></i> Request perubahan CMF tidak di setujui
                                            </div>
                                        @endif
                                    @else
                                        <div class="d-block d-grid gap-2">
                                            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#requestModalMrVerifikasi">Setuju</button>
                                                    <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#dontRequestModalMrVerifikasi">Tidak Setuju</button>
                                        </div>
                                    @endif
                                @endif

                            @endif
                        @endif
                    @else
                        <div class="alert alert-danger">
                            PIC belum mengisi detail aktivitas
                        </div>
                    @endif
                </div>
            </div>
            @endrole
            @role('document control')
            <div class="card mb-4">
                <h5 class="card-header">Verifikasi</h5>
                <hr class="my-0">
                <div class="card-body">
                    @if($cmf->activity)
                        @if($check_signature_step_6 != null)
                            @if($check_signature_step_6->is_signature == 0)
                                <div class="alert alert-danger">Depthead PIC Tidak menyetujui</div>
                            @else
                                @if($check_signature_step_7_signature_0_count != null)
                                    @if($check_signature_step_7_signature_0_count > 0)
                                        <div class="alert alert-danger">Salah satu depthead area terkait ada yang tidak menyetujui</div>
                                    @endif
                                @else
                                    @if($check_signature_step_8 != null)
                                        @if($check_signature_step_8->is_signature == 0)
                                            <div class="alert alert-danger">MR & Food Safety Team tidak menyetujui</div>
                                        @else
                                            @if($check_signature_step_9 != null)
                                                @if($check_signature_step_9->is_signature == 1)
                                                    <div class="text-center mb-4">
                                                        <img src="{{asset('storage/uploads/signature/'. $check_signature->user->signature)}}" alt="" height="80">
                                                    </div>
                                                    <div class="alert alert-success">
                                                        <i class="bx bx-check-circle me-1"></i> Request perubahan CMF berhasil di verifikasi
                                                    </div>
                                                @else
                                                    <div class="alert alert-danger">
                                                        Request Verifikasi CMF Tidak Disetujui
                                                    </div>
                                                @endif
                                            @else
                                                <div class="d-block d-grid gap-2">
                                                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#requestModalDcVerifikasi">Setuju</button>
                                                    <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#dontRequestModalDcVerifikasi">Tidak Setuju</button>
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        <div class="alert alert-danger">Harap bersabar karena proses yang dilakukan secara burutan</div>
                                    @endif
                                @endif
                            @endif
                        @endif
                    @else
                        <div class="alert alert-danger">
                            PIC belum mengisi detail aktivitas
                        </div>
                    @endif
                </div>
            </div>
            @endrole
        </div>
    </div>

    @include('back.cmf.modal')

@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('themes/dropify/dropify.css')}}">
    <style>
        .col-lg-4.sticky-top {
            align-self: flex-start;
        }
    </style>
@endpush

@push('script')
    <script src="{{asset('themes/dropify/dropify.js')}}"></script>
    <script>
        $('.dropify').dropify();
    </script>
    @if (session()->has('print'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#requestModalDcPrint').modal('show');
            });
        </script>
    @endif

@endpush
