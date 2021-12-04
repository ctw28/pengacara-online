@extends('template')

@section('content')
<div class="card-bx bg-blue">
    <img class="pattern-img" src="{{asset('/')}}images/pattern/pattern6.png" alt="">
    <div class="card-info text-white" style="padding:0">
        <!-- <img src="{{asset('/')}}images/pattern/circle.png" alt=""> -->
        <h3 class="text-yellow card-balance">{{$data['kegiatan']->kegiatan_nama}}</h3>
        <span class="fs-18">Sesi Pembayaran :
            {{\Carbon\Carbon::parse($data['pembayaran']->kegiatan_pembayaran_tanggal)->format('d M Y')}}</span>
        <br>
        <br>
        <a href="{{route('user.kegiatan.bayar',$data['kegiatan']->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">Pembayaran Nominal</h4>
        <button id="manage" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal">
            Tambah Pembayaran Nominal</button>
        <!-- Modal -->
        <div class="modal fade" id="basicModal">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Jenis Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <form action="{{route('kegiatan.ampra.add',[$data['kegiatan']->id,$data['pembayaran']->id])}}" method="post">
                                <table class="table table-hover table-striped table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th style="width:50px;">
                                                <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                                    <label class="form-check-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th><strong>Jabatan</strong></th>
                                            <th><strong>Jenis Pembayaran</strong></th>
                                            <th><strong>Honor</strong></th>
                                            <th><strong>Jumlah</strong></th>
                                            <th><strong>Satuan</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @csrf
                                        @foreach ($data['bayarJabatan'] as $row)
                                        @foreach ($row->kegiatanBayarJabatan as $row2)
                                        <tr>
                                            <td>
                                                <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                                                    <input type="checkbox" class="form-check-input" id="customCheckBox2" name="kegiatan_bayar_jabatan_id[]" value="{{$row2->id}}">
                                                    <label class="form-check-label" for="customCheckBox2"></label>
                                                </div>
                                            </td>
                                            <td>{{$row->mKegiatanJabatan->kegiatan_jabatan_nama}}</td>
                                            <td>{{$row2->mBayarKategori->bayar_nama}}</td>
                                            <td>{{$row2->kegiatanBayarJabatanAtur->honor}}</td>
                                            <td>{{$row2->kegiatanBayarJabatanAtur->jumlah}}</td>
                                            <td>{{$row2->kegiatanBayarJabatanAtur->masterSatuan->master_satuan_nama}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endforeach

                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Tambah Pembayaran</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-responsive-sm">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Jabatan</th>
                        <th>Jenis Pembayaran</th>
                        <th>Honor</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="list-data-anggota" class="text-center">
                    @foreach($data['pembayaranSesi'] as $index => $row)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->kegiatanBayarJabatan->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama}}
                        </td>
                        <td>{{$row->kegiatanBayarJabatan->mBayarKategori->bayar_nama}}</td>
                        <td>{{$row->kegiatanBayarJabatan->kegiatanBayarJabatanAtur->honor}}</td>
                        <td>{{$row->kegiatanBayarJabatan->kegiatanBayarJabatanAtur->jumlah}}</td>
                        <td>{{$row->kegiatanBayarJabatan->kegiatanBayarJabatanAtur->masterSatuan->master_satuan_singkatan}}
                        </td>
                        <td><a class="btn btn-info btn-xs" href="{{route('kegiatan.ampra.set',[
                            $data['kegiatan']->id,
                            $data['pembayaran']->id,
                            $row->id
                            ])}}">Bayar Nominal</a></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-danger light sharp" data-bs-toggle="dropdown" aria-expanded="false">
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
                                    <a class="dropdown-item" href="{{route('kegiatan.ampra.destroy',$row->id)}}" onclick="return confirm('Yakin Hapus? ini akan menghapus semua data terkait data yang dihapus')"><i class="las la-times-circle text-danger scale5 me-3"></i>Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection