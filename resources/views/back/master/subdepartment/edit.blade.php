@extends('layouts.back')
@section('title','Edit Department - CMF Online')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Subepartment</h4>

<div class="card mb-4">
    <h5 class="card-header">Edit Subdepartment</h5>
    <div class="card-body">
        <form action="{{ route('subdepartment.update',['subdepartment' => $subdepartment->id]) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="txtIdSubDept" class="form-label">Id Subdepartement</label>
                    <input type="text" name="txtIdSubDept" id="txtIdSubDept" class="form-control" placeholder="Masukkan Id Subdepartment" value="{{ old('txtIdSubDept') ?? $subdepartment->txtIdSubDept }}">
                    @error('txtIdSubDept')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="txtNamaSubDept" class="form-label">Nama Subdepartemen</label>
                    <input type="text" name="txtNamaSubDept" id="txtNamaSubDept" class="form-control" placeholder="Masukkan Nama Subdepartemen" value="{{ old('txtNamaDept') ?? $subdepartment->txtNamaSubDept }}">
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
                <option value="{{ $department->id }}" {{ $subdepartment->department_id == $department->id ? 'selected' : '' }}>{{ $department->txtNamaDept }}</option>
                @empty
                <option>Tidak ada department</option>
                @endforelse
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection
