@extends('layouts.back')
@section('title','Pengajuan CMF - CMF Online')

@section('content')
    <h4 class="fw-bold"><span class="text-muted fw-light">CMF /</span> Pengajuan</h4>

    @if (session()->has('message'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            </div>
        </div>
    @endif

    <div class="card mb-4">
        <h5 class="card-header">Pengajuan CMF</h5>
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
                            <td class="text-primary">{{$cmf->no_cmf}}</td>
                            <td>{{date('d M Y', strtotime($cmf->tanggal))}}</td>
                            <td>{{$cmf->department->txtNamaDept}}</td>
                            <td>{{$cmf->judul_perubahan}}</td>
                            <td>{{date('d M Y', strtotime($cmf->target_implementasi))}}</td>
                            <td>{{$cmf->status_pengajuan}}</td>
                            <td>
                                <a href="{{route('cmf.detail',['slug' => $cmf->slug])}}" class="btn btn-info">Detail</a>
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
