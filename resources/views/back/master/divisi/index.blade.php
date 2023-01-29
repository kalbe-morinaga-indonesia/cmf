@extends('layouts.back')
@section('title','Divisi - CMF Online')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Divisi</h4>

@if (session()->has('messages'))
<div class="card mb-4">
    <div class="card-body">
        <div class="alert alert-success">{{ session()->get('messages') }}</div>
    </div>
</div>
@endif

<div class="card mb-4">
    <h5 class="card-header">Tambah Divisi</h5>
    <div class="card-body">
        <form action="{{ route('divisi.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="txtIdDivisi" class="form-label">Id Divisi</label>
                        <input type="text" name="txtIdDivisi" id="txtIdDivisi" class="form-control" placeholder="Masukkan Id Divisi" value="{{ old('txtIdDivisi') }}">
                        @error('txtIdDivisi')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="txtNamaDivisi" class="form-label">Nama Divisi</label>
                        <input type="text" name="txtNamaDivisi" id="txtNamaDivisi" class="form-control" placeholder="Masukkan Nama Divisi" value="{{ old('txtNamaDivisi') }}">
                        @error('txtNamaDivisi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</div>

<div class="card mb-4">
    <h5 class="card-header">Daftar Divisi</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Id Divisi</th>
                        <th>Nama Divisi</th>
                        <th>Daftar Department</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($divisis as $divisi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $divisi->txtIdDivisi }}</td>
                        <td>{{ $divisi->txtNamaDivisi }}</td>
                        <td>
                            <ol>
                            @forelse ($divisi->departments as $department)
                                <li>{{ $department->txtNamaDept }}</li>
                            @empty
                            <div class="alert alert-danger">Tidak ada department yang terdaftar</div>
                            @endforelse
                            </ol>
                        </td>
                        <td>
                            <a href="{{ route('divisi.edit',['divisi' => $divisi->id]) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('divisi.destroy',['divisi' => $divisi->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger my-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-danger">Tidak ada data</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
