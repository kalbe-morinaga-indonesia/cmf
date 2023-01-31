@extends('layouts.back')
@role('pic')
@section('title','Pengajuan CMF - CMF Online')
@endrole

@role('depthead pic')
@section('title','Request Perubahan CMF - CMF Online')
@endrole

@section('content')
    @role('pic')
        <h4 class="fw-bold"><span class="text-muted fw-light">CMF /</span> Pengajuan</h4>
    @endrole

    @role('depthead pic')
        <h4 class="fw-bold"><span class="text-muted fw-light">CMF /</span> Request Perubahan PIC</h4>
    @endrole

    @if (session()->has('message'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            </div>
        </div>
    @endif

    <div class="card mb-4">
        @role('pic')
            <h5 class="card-header">Pengajuan CMF</h5>
        @endrole
        @role('depthead pic')
            <h5 class="card-header">Request Perubahan CMF</h5>
        @endrole

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="data-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>No CMF</th>
                        <th>Tanggal</th>
                        <th>Department</th>
                        <th>Judul Perubahan</th>
                        <th>Target Implementasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cmfs as $cmf)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="{{route('cmf.detail',['slug' => $cmf->slug])}}">{{$cmf->no_cmf}}</a></td>
                            <td>{{date('d M Y', strtotime($cmf->tanggal))}}</td>
                            <td>{{$cmf->department->txtNamaDept}}</td>
                            <td>{{$cmf->judul_perubahan}}</td>
                            <td>{{date('d M Y', strtotime($cmf->target_implementasi))}}</td>
                            <td>
                                <a href="{{route('cmf.status',['slug' => $cmf->slug])}}"><i class="bx bx-stats me-2"></i>Cek Status</a>
                            </td>
                            <td>
                                <a href="{{route('cmf.detail',['slug' => $cmf->slug])}}" class="btn btn-info mb-2">Detail</a>
                                @if($cmf->step == 7)
                                    <a href="{{route('cmf.review',['slug' => $cmf->slug])}}" target="_blank" class="btn btn-dark">Review</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
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
