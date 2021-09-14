@extends('template')

@section('content')
<div class="col-xl-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h6>Info Kegiatan:</h6>
                    <div><strong>{{$data['kegiatan']->kegiatan_nama}}</strong> </div>
                    <div class="mt-1"> Tanggal Kegiatan :
                        {{\Carbon\Carbon::parse($data['kegiatan']->kegiatan_tanggal)->format('d M Y')}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Pengaturan Jabatan Kegiatan</h4>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#basicModal">
                + Tambah Jabatan</button>
            <!-- Modal -->
            <div class="modal fade" id="basicModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Form Tambah Jabatan Kegiatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('user.kegiatan.jabatan.store')}}" method="post">
                                <div class="col-md-12">
                                    @csrf
                                    <input type="hidden" name="kegiatan_id" value="{{$data['kegiatan']->id}}">
                                    <label class="form-label">Jabatan</label>
                                    <select id="inputState" name="m_kegiatan_jabatan_id"
                                        class="default-select form-control wide mb-4">
                                        <option selected>Pilih Jabatan</option>
                                        @foreach ($data['kegiatanJabatan'] as $row)
                                        <option value="{{$row->id}}">{{$row->kegiatan_jabatan_nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive-sm">
                    <thead class="thead-primary">
                        <tr>
                            <th>#</th>
                            <th>Jabatan</th>
                            <th>Jenis Pembayaran</th>
                            <th>Anggota Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data['kegiatanJabatanData'] as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->mKegiatanJabatan->kegiatan_jabatan_nama}}</td>
                            <td><a class="btn light btn-secondary btn-xs"
                                    href="{{route('user.kegiatan.jabatan.bayar.setup',[$data['kegiatan']->id,$item->id])}}"><i
                                        class="fa fa-gear"></i>
                                    Atur Pembayaran
                                    {{$item->mKegiatanJabatan->kegiatan_jabatan_nama}}</a></td>
                            <td><a class="btn light btn-primary btn-xs"
                                    href="{{route('user.kegiatan.jabatan.peserta',[$data['kegiatan']->id,$item->id])}}"><i
                                        class="fa fa-gear"></i> Atur Anggota
                                    {{$item->mKegiatanJabatan->kegiatan_jabatan_nama}}</a></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-danger light sharp" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                            </g>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu" style="margin: 0px;">
                                        <a class="dropdown-item" href="#"><i
                                                class="las la-times-circle text-danger scale5 me-3"></i>Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
        <!-- <div class="card-footer">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            <button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button>
            <button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
        </div> -->
    </div>
</div>
@endsection

@section('js')

@endsection