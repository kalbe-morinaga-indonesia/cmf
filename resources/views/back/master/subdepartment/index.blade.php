@extends('layouts.back')
@section('title','Department - CMF Online')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Subdepartment</h4>

@if (session()->has('message'))
    <div class="card mb-4">
        <div class="card-body">
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        </div>
    </div>
@endif

<div class="card mb-4">
    <h5 class="card-header">Tambah Subdepartemen</h5>
    <div class="card-body">
        <form action="{{ route('subdepartment.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="txtIdSubDept" class="form-label">Id Subdepartement</label>
                        <input type="text" name="txtIdSubDept" id="txtIdSubDept" class="form-control" placeholder="Masukkan Id Subdepartment" value="{{ old('txtIdSubDept') }}">
                        @error('txtIdSubDept')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="txtNamaSubDept" class="form-label">Nama Subdepartemen</label>
                        <input type="text" name="txtNamaSubDept" id="txtNamaSubDept" class="form-control" placeholder="Masukkan Nama Subdepartemen" value="{{ old('txtNamaDept') }}">
                        @error('txtNamaSubDept')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="department_id" class="form-label">Department</label>
                <select name="department_id" id="department_id" class="form-select">
                    @forelse ($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->txtNamaDept }}</option>
                    @empty
                    <option>Tidak ada department</option>
                    @endforelse
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</div>

<div class="card mb-4">
    <h5 class="card-header">Data Subdepartemen</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Id Subdepartment</td>
                        <td>Nama Subdepartment</td>
                        <td>Department</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subdepartments as $subdepartment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subdepartment->txtIdSubDept }}</td>
                        <td>{{ $subdepartment->txtNamaSubDept }}</td>
                        <td>{{ $subdepartment->department->txtNamaDept }}</td>
                        <td>
                            <a href="{{ route('subdepartment.edit',['subdepartment' => $subdepartment->id]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('subdepartment.destroy',['subdepartment' => $subdepartment->id]) }}" method="post">
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
