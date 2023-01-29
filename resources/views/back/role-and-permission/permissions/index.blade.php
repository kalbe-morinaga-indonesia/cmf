@extends('layouts.back')
@section('title','Permissions - CMF Online')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Role and Permission /</span> Permissions</h4>

    @if (session()->has('message'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            </div>
        </div>
    @endif

    <div class="card mb-4">
        <h5 class="card-header">Tambah Permission</h5>
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama permission" value="{{ old('name') }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="guard_name" class="form-label">Guard Name</label>
                            <input type="text" name="guard_name" id="guard_name" class="form-control" placeholder="web" value="{{ old('guard_name') }}">
                            @error('guard_name')
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
        <h5 class="card-header">Data Permission</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="data-table">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Guard Name</td>
                        <td>Aksi</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td>
                                <a href="{{ route('permissions.edit',['permission' => $permission->id]) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('permissions.destroy',['permission' => $permission->id]) }}" method="post">
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
