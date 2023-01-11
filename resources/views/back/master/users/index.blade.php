@extends('layouts.back')
@section('title','Users - CMF Online')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Divisi</h4>
    <div class="card mb-4">
        <h5 class="card-header">Daftar Users</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>


@endsection
