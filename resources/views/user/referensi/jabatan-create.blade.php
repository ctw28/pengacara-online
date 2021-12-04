@extends('template')

@section('content')
<div class="col-xl-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Jabatan</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{route('referensi.jabatan.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Nama Jabatan <span class="required">*</span></label>
                            <input type="text" class="form-control" name="jabatan_nama" placeholder="Tuliskan nama jabatan" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Keterangan</label>
                            <div class="mb-3">
                                <textarea style="height:100px" class="form-control bg-transparent" cols="30" rows="5" name="jabatan_keterangan"></textarea>
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