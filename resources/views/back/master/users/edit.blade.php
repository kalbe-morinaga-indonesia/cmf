@extends('layouts.back')
@section('title','Users - CMF Online')

@section('content')
    <h4 class="fw-bold"><span class="text-muted fw-light">Master / Users / </span> Edit</h4>

    <div class="row-mb-4">
        <div class="col-lg-12">
            <div class="alert alert-info">
                <strong><i class="bx bxs-info-circle me-1"></i>Informasi</strong>
                <br>
                <span class="text-danger">*</span> Form wajib diisi
            </div>
        </div>
    </div>

    <form action="{{route('users.update',['user' => $user->id])}}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
        @method('put')
        @csrf
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nik" class="form-label">NIK (Nomor Induk Karyawan)<span class="text-danger">*</span></label>
                                    <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukkan nomor induk karyawan" value="{{old('nik') ?? $user->nik}}">
                                    @error('nik')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nama<span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{old('name') ?? $user->name}}">
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password">
                                    @error('password')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Masukkan password Konfirmasi">
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="department" class="form-label">Department<span class="text-danger">*</span></label>
                                    <select name="department" id="department" class="form-select @error('department') is-invalid @enderror">
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{$user->department_id ==  $department->id ? 'selected' : ''}}>{{$department->txtNamaDept}}</option>
                                        @endforeach
                                        @error('department')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="subdepartment" class="form-label">Sub-Department</label>
                                    <select name="subdepartment" id="subdepartment" class="form-select @error('subdepartment') is-invalid @enderror">
                                        <option value=""></option>
                                        @foreach($subdepartments as $subdepartment)
                                            <option value="{{$subdepartment->id}}" {{$user->subdepartment_id == $subdepartment->id ? 'selected' : ''}}>{{$subdepartment->txtNamaSubDept}}</option>
                                        @endforeach
                                        @error('subdepartment')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label for="signature" class="form-label">Tanda Tangan<span class="text-danger">*</span></label>
                                <input type="file" name="signature" id="signature" class="dropify" data-allowed-file-extensions="jpg jpeg png webp" data-max-file-size-preview="5M" data-default-file="{{asset('storage/uploads/signature/'.$user->signature)}}">
                            </div>
                            <div class="col-lg-6">
                                <label for="avatar" class="form-label">Photo Profile<span class="text-danger">*</span></label>
                                <input type="file" name="avatar" id="avatar" class="dropify" data-allowed-file-extensions="jpg jpeg png webp" data-max-file-size-preview="3M" data-default-file="{{asset('storage/uploads/users/'.$user->avatar)}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('themes/dropify/dropify.css')}}">
@endpush

@push('script')
    <script src="{{asset('themes/dropify/dropify.js')}}"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endpush
