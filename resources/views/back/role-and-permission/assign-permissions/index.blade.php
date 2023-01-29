@extends('layouts.back')
@section('title','Assign Permissions - CMF Online')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Role and Permission /</span> Assign Permissions</h4>

    @if (session()->has('message'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            </div>
        </div>
    @endif

    <div class="card mb-4">
        <h5 class="card-header">Assign Permission</h5>
        <div class="card-body">
            <form action="{{ route('assign-permissions.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="role" class="form-label">Name</label>
                    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{old('role') == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                        @endforeach
                    </select>
                    @error('role')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="permission" class="form-label">Permission</label>
                    <div class="form-group">
                        @foreach($permissions as $permission)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="permission[]" id="permission" value="{{$permission->id}}">
                                <label class="form-check-label" for="permission">{{$permission->name}}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('permission')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <h5 class="card-header">Data Assign Permissions</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="data-table">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Permission</td>
                        <td>Aksi</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($role->getPermissionNames() as $item)
                                    <button class="btn btn-primary btn-sm">{{$item}}</button>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('assign-permissions.sync',['role' => $role->id]) }}" class="btn btn-warning">Sync</a>
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
