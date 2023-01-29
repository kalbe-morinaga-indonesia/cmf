@extends('layouts.back')
@section('title','Users - CMF Online')

@section('content')
    <h4 class="fw-bold"><span class="text-muted fw-light">Master /</span> Users</h4>
    <a href="{{route('users.create')}}" class="btn btn-primary mb-4">Tambah</a>

    @if (session()->has('message'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            </div>
        </div>
    @endif

    <div class="card mb-4">
        <h5 class="card-header">Daftar Users</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nik</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanda Tangan</th>
                            <th>Avatar</th>
                            <th>Departemen</th>
                            <th>Sub Departemen</th>
                            <th>Created at</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->nik}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <img src="{{asset('storage/uploads/signature/'.$user->signature)}}" class="img-fluid img-thumbnail" alt="{{$user->name}}">
                            </td>
                            <td>
                                <img src="{{asset('storage/uploads/users/'.$user->avatar)}}" class="img-fluid img-thumbnail" alt="{{$user->name}}">
                            </td>
                            <td>{{$user->department->txtNamaDept ?? 'n/a'}}</td>
                            <td>{{$user->subdepartment->txtNamaSubDept ?? 'n/a'}}</td>
                            <td>{{$user->created_at->format('d M Y')}}</td>
                            <td>
                                @if($user->email != auth()->user()->email)
                                    <a href="{{route('users.edit',['user' => $user->id])}}" class="btn btn-dark mb-3">Edit</a>
                                    <form action="{{route('users.destroy',['user' => $user->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                @endif
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
