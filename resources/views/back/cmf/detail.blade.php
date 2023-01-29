@extends('layouts.back')
@section('title','Detail CMF - CMF Online')

@section('content')
    <h4 class="fw-bold"><span class="text-muted fw-light">CMF /</span> Detail</h4>

    @if (session()->has('message'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            </div>
        </div>
    @endif

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


@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#data-table').DataTable();
        });
    </script>
@endpush
