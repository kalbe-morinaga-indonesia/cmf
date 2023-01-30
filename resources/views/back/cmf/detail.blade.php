@extends('layouts.back')

@role('pic')
    @section('title','Detail CMF - CMF Online')
@endrole

@role('depthead pic')
    @section('title','Request Perubahan CMF - CMF Online')
@endrole

@section('content')
    @role('pic')
        <h4 class="fw-bold"><span class="text-muted fw-light">CMF /</span> Detail</h4>
    @endrole

    @role('depthead pic')
        <h4 class="fw-bold"><span class="text-muted fw-light">CMF /</span> Detail Request Perubahan CMF</h4>
    @endrole


    @if (session()->has('message'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            </div>
        </div>
    @endif

    @role('pic')
    <div class="row-mb-4">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control bg-info text-white" value="{{$cmf->department->txtNamaDept}}" disabled>
                        </div>
                        <div class="col-lg-3">
                            <label for="no_cmf" class="form-label">No CMF</label>
                            <input type="text" class="form-control bg-info text-white" value="{{$cmf->no_cmf}}" disabled>
                        </div>
                        <div class="col-lg-3">
                            <label for="inserted_by" class="form-label">Diajukan Oleh</label>
                            <input type="text" class="form-control bg-info text-white" value="{{$cmf->inserted_by}}" disabled>
                        </div>
                        <div class="col-lg-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control bg-info text-white" value="{{$cmf->status_pengajuan}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    @role('depthead pic')
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control bg-info text-white" value="{{$cmf->department->txtNamaDept}}" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label for="no_cmf" class="form-label">No CMF</label>
                            <input type="text" class="form-control bg-info text-white" value="{{$cmf->no_cmf}}" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <label for="inserted_by" class="form-label">Diajukan Oleh</label>
                            <input type="text" class="form-control bg-info text-white" value="{{$cmf->inserted_by}}" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control bg-info text-white" value="{{$cmf->status_pengajuan}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <h5 class="card-header">Keputusan Perubahan</h5>
                <hr class="my-0">
                <div class="card-body">
                    @if($check_signature != null)
                        @if($check_signature->is_signature == 1 && $check_signature->step == 1)
                            <div class="text-center mb-4">
                                <img src="{{asset('storage/uploads/signature/'. $check_signature->user->signature)}}" alt="" height="80">
                            </div>
                            <div class="alert alert-success">
                                <i class="bx bx-check-circle me-1"></i> Pengajuan Request Perubahan CMF sudah ditanda tangan dan sudah disetujui
                            </div>
                        @elseif($check_signature->is_signature == 0 && $check_signature->step == 1)
                            <div class="alert alert-danger">
                                <i class="bx bx-check-circle me-1"></i> Pengajuan Request Perubahan CMF tidak disetujui
                            </div>
                        @endif
                    @else
                        <div class="d-block d-grid gap-2">
                            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#requestModal">Setuju</button>
                            <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#dontRequestModal">Tidak Setuju</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endrole

    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <h5 class="card-header">Pengajuan CMF</h5>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="judul_perubahan" class="form-label">Judul Perubahan</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="{{$cmf->judul_perubahan}}" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="perubahan" class="form-label">Perubahan</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="{{$cmf->perubahan}}" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="tanggal" class="form-label">Tanggal</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="{{date('d M Y', strtotime($cmf->tanggal))}}" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="jenis_perubahan" class="form-label">Jenis Perubahan</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="{{$cmf->jenis_perubahan}}" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="target_implementasi" class="form-label">Target Implementasi</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="{{date('d M Y', strtotime($cmf->target_implementasi))}}" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="tipe_perubahan" class="form-label">Tipe Perubahan</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="{{$cmf->tipe_perubahan}}" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="alasan_perubahan" class="form-label">Alasan Perubahan</label>
                        </div>
                        <div class="col-lg-8">
                            <textarea cols="30" rows="10" class="form-control" disabled>{{$cmf->alasan_perubahan}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="dampak_terhadap_perubahan" class="form-label">Dampak Terhadap Perubahan</label>
                        </div>
                        <div class="col-lg-8">
                            <textarea cols="30" rows="10" class="form-control" disabled>{{$cmf->dampak_terhadap_perubahan}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <label for="deskripsi_perubahan" class="form-label">Deskripsi Perubahan</label>
                        </div>
                        <div class="col-lg-8">
                            <textarea cols="30" rows="10" class="form-control" disabled>{{$cmf->deskripsi_perubahan}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <h5 class="card-header">Area Terkait</h5>
                        <hr class="my-0">
                        <div class="card-body">
                            @foreach($cmf->subdepartments as $item)
                                <span class="badge rounded-pill bg-primary">{{$item->txtNamaSubDept}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <h5 class="card-header">Konfirmasi Department Terkait</h5>
                        <hr class="my-0">
                        <div class="card-body">
                            @foreach($cmf->departments as $item)
                                <span class="badge rounded-pill bg-primary">{{$item->txtNamaDept}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            @foreach($cmf->risks as $risk)
                <div class="card mb-4">
                    <h5 class="card-header">Risk Assessment <span class="text-danger">{{$loop->iteration}}</span></h5>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label for="qcdsme" class="form-label">QCDSME</label>
                            <input type="text" class="form-control" value="{{$risk->qcdsme}}" disabled>
                        </div>
                        <div class="form-group mb-4">
                            <label for="resiko" class="form-label">Resiko</label>
                            <input type="text" class="form-control" value="{{$risk->resiko}}" disabled>
                        </div>
                        <div class="form-group mb-4">
                            <label for="rencana_mitigasi" class="form-label">Rencana Mitigasi</label>
                            <textarea name="rencana_mitigasi" id="rencana_mitigasi" class="form-control" disabled>{{$risk->rencana_mitigasi}}</textarea>
                        </div>
                        <div class="form-group mb-4">
                            <label for="rica" class="form-label">Rica</label>
                            <input type="text" class="form-control" value="{{$risk->rica}}" disabled>
                        </div>
                        <div class="form-group mb-4">
                            <label for="pic" class="form-label">PIC</label>
                            <input type="text" class="form-control" value="{{$risk->pic}}" disabled>
                        </div>
                        <div class="form-group mb-4">
                            <label for="deadline" class="form-label">deadline</label>
                            <input type="text" class="form-control" value="{{date('d M Y', strtotime($risk->deadline))}}" disabled>
                        </div>
                        <div class="form-group mb-4">
                            <label for="level_risk" class="form-label">Level Risk</label>
                            <input type="text" class="form-control
                            @if($risk->level_risk == 'High')
                                bg-danger text-white
                            @elseif($risk->level_risk == 'Medium')
                                bg-warning text-white
                            @elseif($risk->level_risk == 'Low')
                                bg-success text-white
                            @endif
                            " value="{{$risk->level_risk}}" disabled>
                        </div>
                        <div class="form-group mb-4">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control
                            @if($risk->status == 'Open' || $risk->status == 'open')
                                bg-success text-white
                            @elseif($risk->status == 'closed' || $risk->status == 'Closed')
                                bg-dark text-white
                            @endif
                            " value="{{$risk->status}}" disabled>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @role('depthead pic')
    <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Perubahan CMF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menyetujui <strong>Request Perubahan CMF ini?</strong> Harap periksa kembali Request perubahan CMF yang diajukan, apabila anda sudah menyetujui maka tidak dapat dirubah kembali</p>
                    <form action="{{route('cmf.signature',['slug' => $cmf->slug])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="no_cmf" class="form-label">NO CMF</label>
                            <input type="text" name="no_cmf" id="no_cmf" class="form-control bg-dark text-white" value="{{$cmf->no_cmf}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="signature" class="form-label">Tanda Tangan<span class="text-danger">*</span></label>
                            <input type="file" name="signature" id="signature" class="dropify" data-allowed-file-extensions="jpg jpeg png webp" data-max-file-size-preview="3M" data-default-file="{{asset('storage/uploads/signature/'.auth()->user()->signature)}}">
                        </div>
                        <small class="">Apabila ingin mengganti tanda tangan, silahkan upload tanda tangan terbaru anda. Jika tidak, abaikan saja dan langsung tekan tombol tanda tangan</small>
                        <div class="my-4 text-end">
                            <button type="submit" class="btn btn-dark"><i class="bx bx-edit me-2"></i>Setuju & Tanda Tangan Request Perubahan CMF</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dontRequestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Perubahan CMF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk tidak menyetujui <strong>Request Perubahan CMF ini?</strong> Harap periksa kembali Request perubahan CMF yang diajukan, apabila anda tidak menyetujui maka tidak dapat dirubah kembali</p>
                    <form action="{{route('cmf.revised',['slug' => $cmf->slug])}}" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="no_cmf" class="form-label">NO CMF</label>
                            <input type="text" name="no_cmf" id="no_cmf" class="form-control bg-dark text-white" value="{{$cmf->no_cmf}}" readonly>
                        </div>
                        <div class="my-4 text-end">
                            <button type="submit" class="btn btn-danger"><i class="bx bx-mail-send me-2"></i>Tidak Setuju </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endrole

@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('themes/dropify/dropify.css')}}">
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            $('#data-table').DataTable();
        });
    </script>
    <script src="{{asset('themes/dropify/dropify.js')}}"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endpush
