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
            <form action="{{ route('assign-users.update',['user' => $user->id]) }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <select name="email" id="email" class="form-select @error('email') is-invalid @enderror">
                        @foreach($users as $item)
                            <option value="{{$item->email}}" {{$item->email == $user->email ? 'selected' : ''}}>{{$item->email}}</option>
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
                                <input class="form-check-input" type="checkbox" name="roles[]" id="roles" value="{{$role->id}}" {{$role->permissions()->find($role->id) ? 'checked' : ''}}>
                                <label class="form-check-label" for="roles">{{$role->name}}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('roles')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Sync</button>
            </form>
        </div>
    </div>

@endsection
