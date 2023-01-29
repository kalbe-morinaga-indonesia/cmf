@extends('layouts.back')
@section('title','Permissions - CMF Online')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Role and Permission /</span> Permissions</h4>

    <div class="card mb-4">
        <h5 class="card-header">Edit Permission</h5>
        <div class="card-body">
            <form action="{{ route('permissions.update',['permission' => $permission->id]) }}" method="post">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama role" value="{{ old('name') ?? $permission->name }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="guard_name" class="form-label">Guard Name</label>
                            <input type="text" name="guard_name" id="guard_name" class="form-control" placeholder="web" value="{{ old('guard_name') ?? $permission->guard_name }}">
                            @error('guard_name')
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
