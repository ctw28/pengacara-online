@extends('template')

@section('content')
<div class="col-xl-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Kegiatan</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{route('user.kegiatan.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Nama Kegiatan <span class="required">*</span></label>
                            <textarea style="height:100px" class="form-control bg-transparent" cols="30" rows="5"
                                name="kegiatan_nama"></textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Tanggal Kegiatan <span class="required">*</span></label>
                            <div class="mb-3">
                                <input type="date" class="form-control" name="kegiatan_tanggal" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <h6>Keterangan RKKL</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Sub Kegiatan <span class="required">*</span></label>
                            <input type="text" class="form-control" name="kegiatan_sub_kegiatan" placeholder="">
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">Akun <span class="required">*</span></label>
                            <input type="text" class="form-control" name="kegiatan_akun" placeholder="">
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">No. Bukti</label>
                            <input type="text" class="form-control" name="kegiatan_no_bukti" placeholder="">
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <h6>Surat Keterangan</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label>No. SK <span class="required">*</span></label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="kegiatan_sk" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Tanggal SK <span class="required">*</span></label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="kegiatan_sk_tanggal" placeholder="">
                                </div>
                            </div>

                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection