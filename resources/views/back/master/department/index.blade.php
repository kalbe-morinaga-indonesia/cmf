@extends('layouts.back')
@section('title','Department - CMF Online')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Department</h4>

@if (session()->has('message'))
    <div class="card mb-4">
        <div class="card-body">
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        </div>
    </div>
@endif

<div class="card mb-4">
    <h5 class="card-header">Tambah Departemen</h5>
    <div class="card-body">
        <form action="{{ route('department.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="txtIdDept" class="form-label">Id Departement</label>
                        <input type="text" name="txtIdDept" id="txtIdDept" class="form-control" placeholder="Masukkan Id Department" value="{{ old('txtIdDept') }}">
                        @error('txtIdDept')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="txtNamaDept" class="form-label">Nama Departemen</label>
                        <input type="text" name="txtNamaDept" id="txtNamaDept" class="form-control" placeholder="Masukkan Nama Departemen" value="{{ old('txtNamaDept') }}">
                        @error('txtNamaDept')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="divisi_id" class="form-label">Divisi</label>
                <select name="divisi_id" id="divisi_id" class="form-select">
                    @forelse ($divisis as $divisi)
                    <option value="{{ $divisi->id }}" {{ old('divisi_id') == $divisi->id ? 'selected' : '' }}>{{ $divisi->txtNamaDivisi }}</option>
                    @empty
                    <option>Tidak ada divisi</option>
                    @endforelse
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</div>

<div class="card mb-4">
    <h5 class="card-header">Data Departemen</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Id Department</td>
                        <td>Nama Department</td>
                        <td>Divisi</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $department->txtIdDept }}</td>
                        <td>{{ $department->txtNamaDept }}</td>
                        <td>{{ $department->divisi->txtNamaDivisi }}</td>
                        <td>
                            <a href="{{ route('department.edit',['department' => $department->id]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('department.destroy',['department' => $department->id]) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger my-2">Delete</button>
                            </form>
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
