@extends('layouts.back')
@section('title','Edit Divisi - CMF Online')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Divisi</h4>
<div class="card mb-4">
    <h5 class="card-header">Edit Divisi</h5>
    <div class="card-body">
        <form action="{{ route('divisi.update',['divisi' => $divisi->id]) }}" method="post">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="txtIdDivisi" class="form-label">Id Divisi</label>
                        <input type="text" name="txtIdDivisi" id="txtIdDivisi" class="form-control" placeholder="Masukkan Id Divisi" value="{{ old('txtIdDivisi') ?? $divisi->txtIdDivisi }}">
                        @error('txtIdDivisi')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="txtNamaDivisi" class="form-label">Nama Divisi</label>
                        <input type="text" name="txtNamaDivisi" id="txtNamaDivisi" class="form-control" placeholder="Masukkan Nama Divisi" value="{{ old('txtNamaDivisi') ?? $divisi->txtNamaDivisi }}">
                        @error('txtNamaDivisi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>

@endsection
