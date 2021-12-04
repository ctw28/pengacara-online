@extends('template')

@section('content')
<div class="col-xl-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Surat Keputusan</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{route('rutin.sk.update',$data['dataSK']->id)}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>No. SK <span class="required">*</span></label>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="sk" value="{{$data['dataSK']->sk}}" placeholder="" required>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Tanggal SK <span class="required">*</span></label>
                            <div class="mb-3">
                                <input type="date" class="form-control" name="sk_tanggal" value="{{$data['dataSK']->sk_tanggal}}" placeholder="" required>
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
                            <input type="text" class="form-control" name="sub_kegiatan" value="{{$data['dataSK']->sub_kegiatan}}" placeholder="" required>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">Akun <span class="required">*</span></label>
                            <input type="text" class="form-control" name="akun" value="{{$data['dataSK']->akun}}" placeholder="" required>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">No. Bukti</label>
                            <input type="text" class="form-control" name="no_bukti" value="{{$data['dataSK']->no_bukti}}" placeholder="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <h6>Status SK</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 mb-0">
                            <label class="radio-inline me-3"><input type="radio" name="is_aktif" value="1" @if($data['dataSK']->is_aktif=="1" ) checked @endif> Berlaku</label>
                            <label class="radio-inline me-3"><input type="radio" name="is_aktif" value="0" @if($data['dataSK']->is_aktif=="0" ) checked @endif> Tidak Berlaku</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection