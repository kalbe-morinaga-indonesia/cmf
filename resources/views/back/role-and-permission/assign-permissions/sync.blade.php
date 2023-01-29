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
            <form action="{{ route('assign-permissions.update',['role' => $role->id]) }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="role" class="form-label">Name</label>
                    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                        @foreach($roles as $item)
                            <option value="{{$item->id}}" {{$item->id == $role->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('role')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="permission" class="form-label">Guard Name</label>
                    <div class="form-group">
                        @foreach($permissions as $permission)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="permission[]" id="permission" value="{{$permission->id}}" {{$role->permissions()->find($permission->id) ? 'checked' : ''}}>
                                <label class="form-check-label" for="permission">{{$permission->name}}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('permission')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Sync</button>
            </form>
        </div>
    </div>

@endsection
