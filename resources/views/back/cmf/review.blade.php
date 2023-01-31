@extends('layouts.back')
@section('title','Review Perubahan CMF - CMF Online')

@section('content')
    <h4 class="fw-bold"><span class="text-muted fw-light">CMF / </span> Review Perubahan</h4>
    <div class="row">
        <div class="col-lg-8">
            <a href="#" class="btn btn-primary mb-4">Cek detail CMF</a>
            @if($check_signature_step_1)
                <div class="row">
                    <div class="col-lg-12">
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
                                                <p class="card-header text-center text-dark">Catatan Depthead {{$review->review->department->txtNamaDept}}</p>
                                                <p>{{$review->review->review ?? 'Tidak ada review'}}</p>
                                            </div>
                                            <div class="col-lg-3">
                                                <p class="text-center text-dark card-header">Disetujui Oleh</p>
                                                <div class="text-center">
                                                    <img src="{{asset('storage/uploads/signature/'. $check_signature_step_1->user->signature)}}" alt="" height="80">
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
            <div class="card mb-4">
                <h5 class="card-header">Detail Aktivitas</h5>
                <div class="card-body">
                    <form action="#" method="post">
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
                            <button type="submit" class="btn btn-dark"><i class="bx bx-send me-2"></i>Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .col-lg-4.sticky-top {
            align-self: flex-start;
        }
    </style>
@endpush
