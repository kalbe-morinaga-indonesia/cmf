@extends('layouts.back')
@section('title','Assign Users - CMF Online')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Role and Permission /</span> Assign Users</h4>

    @if (session()->has('message'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            </div>
        </div>
    @endif

    <div class="card mb-4">
        <h5 class="card-header">Assign Users</h5>
        <div class="card-body">
            <form action="{{ route('assign-users.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <select name="email" id="email" class="form-select @error('email') is-invalid @enderror">
                        @foreach($users as $user)
                            <option value="{{$user->email}}" {{old('email') == $user->email ? 'selected' : ''}}>{{$user->email}}</option>
                        @endforeach
                    </select>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="roles" class="form-label">Roles</label>
                    <div class="form-group">
                        @foreach($roles as $role)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="roles[]" id="role" value="{{$role->id}}">
                                <label class="form-check-label" for="role">{{$role->name}}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('roles')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <h5 class="card-header">Data Assign Users</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Roles</td>
                        <td>Aksi</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->getRoleNames() as $item)
                                    <button class="btn btn-primary btn-sm">{{$item}}</button>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('assign-users.sync',['user' => $user->id]) }}" class="btn btn-warning">Sync</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
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
