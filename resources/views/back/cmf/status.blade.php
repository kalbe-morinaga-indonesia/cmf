@extends('layouts.back')
@section('title','Status CMF - CMF Online')

@section('content')
    <h4 class="fw-bold"><span class="text-muted fw-light">CMF /</span> Status PIC</h4>

    @if (session()->has('message'))
        <div class="card mb-4">
            <div class="card-body">
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            </div>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <h5 class="card-header">Status CMF</h5>
                <div class="card-body">
                    @foreach($check_signature_pic as $signature)
                            <div class="form-group mb-4">
                                <label class="form-label">Depthead PIC</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{$signature->is_signature == 1 ? 'checked' : ''}} readonly>
                                    <label class="form-check-label">
                                        Disetujui Depthead PIC
                                    </label>
                                </div>
                            </div>
                    @endforeach

                    <div class="form-group mb-4">
                        <label class="form-label">Depthead Area Terkait</label>
                        <br>
                        @foreach($cmf->departments as $department)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" @foreach ($check_signature_depthead as $signature) {{$signature->user->department->id
                                        == $department->id && $signature->is_signature == 1 ? 'checked' : ''}} @endforeach>
                                        <label class="form-check-label">
                                            Disetujui Depthead {{$department->txtNamaDept}}
                                        </label>
                                    </div>
                        @endforeach
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label">SVP System</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Disetujui SVP System
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label">MNF</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Disetujui MNF
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label">MR & Food Safety Team</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Disetujui MR & Food Safety Team
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label">Document Control</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Disetujui Document Control
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <h5 class="card-header">History CMF</h5>
                <hr class="my-0">
                <div class="card-body">
                    <ul>
                        @foreach($histories as $history)
                            <li>{{$history->keterangan}} (<span class="text-primary">{{$history->created_at->format('d M Y, H:i:s')}}</span>)</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
