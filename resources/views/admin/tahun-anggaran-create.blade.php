@extends('template')


@section('css')
<link rel="stylesheet" href="{{asset('/')}}vendor/select2/css/select2.min.css">
@endsection

@section('content')
<div class="col-xl-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Tahun Anggaran</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{route('admin.tahun.anggaran.simpan')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label class="form-label">Tahun Anggaran</label>
                            <input type="text" max="4" class="form-control" placeholder="contoh 2021 / 2022"
                                name="tahun_anggaran">
                        </div>
                        <div class="mb-3 col-md-9">
                            <label class="form-label">Sebutan Tahun Anggaran</label>
                            <input type="text" class="form-control" name="tahun_anggaran_sebutan" placeholder="">
                        </div>

                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Pejabat Bendaraha Pengeluaran</label>
                                <select id="idpeg" name="idpeg" class="js-data-example-ajax w-100">
                                    <option>Pilih Pegawai</option>
                                    @foreach ($pegawai as $item)
                                    <option value="{{$item['idpeg']}}">{{$item['nip']}} - {{$item['nama']}}</option>
                                    @endforeach


                                </select>
                                <!-- <select id="idpeg" name="idpeg" class="default-select form-control wide select2">
                                    <option selected>Pilih Pegawai</option>
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select> -->
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Keterangan</label>
                                <div class="mb-3">
                                    <textarea class="textarea_editor form-control bg-transparent" rows="30"
                                        name="keterangan"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Status Jabatan</label>
                                <div class="mb-3 mb-0">
                                    <label class="radio-inline me-3"><input type="radio" name="is_aktif" value="1">
                                        Aktif</label>
                                    <label class="radio-inline me-3"><input type="radio" name="is_aktif" value="0">
                                        Tidak
                                        Aktid</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label>Tanggal Dipa</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="dipa_tgl" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Nomor Dipa</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="dipa_nomor" placeholder="">
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
@section('js')
<script src="{{asset('/')}}vendor/select2/js/select2.full.min.js"></script>
<script>
$(document).ready(function() {
    $(".js-data-example-ajax").select2();
});
</script>
@endsection