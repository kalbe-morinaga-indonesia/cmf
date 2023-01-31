@role('depthead pic')
<div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Perubahan CMF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk menyetujui <strong>Request Perubahan CMF ini?</strong> Harap periksa kembali Request perubahan CMF yang diajukan, apabila anda sudah menyetujui maka tidak dapat dirubah kembali</p>
                <form action="{{route('cmf.signature',['slug' => $cmf->slug])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="no_cmf" class="form-label">NO CMF</label>
                        <input type="text" name="no_cmf" id="no_cmf" class="form-control bg-dark text-white" value="{{$cmf->no_cmf}}" readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control form-control-lg"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="signature" class="form-label">Tanda Tangan<span class="text-danger">*</span></label>
                        <input type="file" name="signature" id="signature" class="dropify" data-allowed-file-extensions="jpg jpeg png webp" data-max-file-size-preview="3M" data-default-file="{{asset('storage/uploads/signature/'.auth()->user()->signature)}}">
                    </div>
                    <small class="">Apabila ingin mengganti tanda tangan, silahkan upload tanda tangan terbaru anda. Jika tidak, abaikan saja dan langsung tekan tombol tanda tangan</small>
                    <div class="my-4 text-end">
                        <button type="submit" class="btn btn-dark"><i class="bx bx-edit me-2"></i>Setuju & Tanda Tangan Request Perubahan CMF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="dontRequestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Perubahan CMF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk tidak menyetujui <strong>Request Perubahan CMF ini?</strong> Harap periksa kembali Request perubahan CMF yang diajukan, apabila anda tidak menyetujui maka tidak dapat dirubah kembali</p>
                <form action="{{route('cmf.revised',['slug' => $cmf->slug])}}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="no_cmf" class="form-label">NO CMF</label>
                        <input type="text" name="no_cmf" id="no_cmf" class="form-control bg-dark text-white" value="{{$cmf->no_cmf}}" readonly>
                    </div>
                    <div class="my-4 text-end">
                        <button type="submit" class="btn btn-danger"><i class="bx bx-mail-send me-2"></i>Tidak Setuju </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Catatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-4">
                    <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control form-control-lg" readonly>{{$check_signature->catatan ?? 'Tidak ada catatan'}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole

@role('depthead')
<div class="modal fade" id="requestModalDepthead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Review CMF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk menyetujui <strong>Request Review CMF ini?</strong> Harap periksa kembali Request perubahan CMF yang diajukan, apabila anda sudah menyetujui maka tidak dapat dirubah kembali</p>
                <form action="{{route('cmf.signature',['slug' => $cmf->slug])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="no_cmf" class="form-label">NO CMF</label>
                        <input type="text" name="no_cmf" id="no_cmf" class="form-control bg-dark text-white" value="{{$cmf->no_cmf}}" readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label for="review" class="form-label">Review</label>
                        <textarea name="review" id="review" cols="30" rows="10" class="form-control form-control-lg"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="signature" class="form-label">Tanda Tangan<span class="text-danger">*</span></label>
                        <input type="file" name="signature" id="signature" class="dropify" data-allowed-file-extensions="jpg jpeg png webp" data-max-file-size-preview="3M" data-default-file="{{asset('storage/uploads/signature/'.auth()->user()->signature)}}">
                    </div>
                    <div class="my-4 text-end">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-check-circle me-2"></i>Iya, saya setuju</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="dontRequestModalDepthead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Review CMF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk tidak menyetujui <strong>Request Review CMF ini?</strong> Harap periksa kembali Request Review CMF yang diajukan, apabila anda tidak menyetujui maka tidak dapat dirubah kembali</p>
                <form action="{{route('cmf.revised',['slug' => $cmf->slug])}}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="no_cmf" class="form-label">NO CMF</label>
                        <input type="text" name="no_cmf" id="no_cmf" class="form-control bg-dark text-white" value="{{$cmf->no_cmf}}" readonly>
                    </div>
                    <div class="my-4 text-end">
                        <button type="submit" class="btn btn-danger"><i class="bx bx-mail-send me-2"></i>Tidak Setuju </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-4">
                    <textarea cols="30" rows="10" class="form-control form-control-lg" readonly>{{$check_signature->review->review ?? 'Tidak ada Review'}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole

@role('svp system')
<div class="modal fade" id="requestModalSvp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Review CMF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk menyetujui <strong>Request Review CMF ini?</strong> Harap periksa kembali Request perubahan CMF yang diajukan, apabila anda sudah menyetujui maka tidak dapat dirubah kembali</p>
                <form action="{{route('cmf.signature',['slug' => $cmf->slug])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="no_cmf" class="form-label">NO CMF</label>
                        <input type="text" name="no_cmf" id="no_cmf" class="form-control bg-dark text-white" value="{{$cmf->no_cmf}}" readonly>
                    </div>
                    <div class="my-4 text-end">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-check-circle me-2"></i>Iya, saya setuju</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="dontRequestModalSvp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Review CMF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk tidak menyetujui <strong>Request Review CMF ini?</strong> Harap periksa kembali Request Review CMF yang diajukan, apabila anda tidak menyetujui maka tidak dapat dirubah kembali</p>
                <form action="{{route('cmf.revised',['slug' => $cmf->slug])}}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="no_cmf" class="form-label">NO CMF</label>
                        <input type="text" name="no_cmf" id="no_cmf" class="form-control bg-dark text-white" value="{{$cmf->no_cmf}}" readonly>
                    </div>
                    <div class="my-4 text-end">
                        <button type="submit" class="btn btn-danger"><i class="bx bx-mail-send me-2"></i>Tidak Setuju </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endrole
