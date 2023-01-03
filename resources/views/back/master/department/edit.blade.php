@extends('layouts.back')
@section('title','Edit Department - CMF Online')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Department</h4>

<div class="card mb-4">
    <h5 class="card-header">Edit Department</h5>
    <div class="card-body">
        <form action="{{ route('department.update',['department' => $department->id]) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="txtIdDept" class="form-label">Id Departement</label>
                    <input type="text" name="txtIdDept" id="txtIdDept" class="form-control" placeholder="Masukkan Id Department" value="{{ old('txtIdDept') ?? $department->txtIdDept }}">
                    @error('txtIdDept')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="txtNamaDept" class="form-label">Nama Departemen</label>
                    <input type="text" name="txtNamaDept" id="txtNamaDept" class="form-control" placeholder="Masukkan Nama Departemen" value="{{ old('txtNamaDept') ?? $department->txtNamaDept }}">
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
                <option value="{{ $divisi->id }}" {{ $department->divisi_id == $divisi->id ? 'selected' : '' }}>{{ $divisi->txtNamaDivisi }}</option>
                @empty
                <option>Tidak ada divisi</option>
                @endforelse
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection
