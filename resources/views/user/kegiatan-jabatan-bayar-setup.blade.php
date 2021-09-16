@extends('template')

@section('content')
<div class="col-xl-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="">Info Kegiatan:</h4>
            <p>{{$data['kegiatan']->kegiatan_nama}}</p>

            <a href="{{route('user.kegiatan.setup',$data['kegiatan']->id)}}" class="btn btn-warning btn-xs"><i
                    class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Jenis Pembayaran</h4>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#basicModal">+ Tambah
                Jenis Pembayaran</button>
            <!-- Modal -->
            <div class="modal fade" id="basicModal">
                <div class="modal-dialog  modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Form Tambah Jenis Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="basic-form">
                                <form action="{{route('user.kegiatan.jabatan.bayar.setup.store')}}" method="post">
                                    <div class="row">
                                        @csrf
                                        <input type="hidden" name="kegiatan_jabatan_id"
                                            value="{{$data['kegiatanJabatan']->id}}">
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Jenis Pembayaran</label>
                                            <select id="inputState" name="m_bayar_kategori_id"
                                                class="default-select form-control wide" required>
                                                <option value="" selected>Pilih Jenis</option>
                                                @foreach ($data['bayarKategori'] as $row)
                                                <option value="{{$row->id}}">{{$row->bayar_nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Honor</label>
                                            <input type="text" id="honor" name="honor" class="form-control"
                                                placeholder="Rp......" required>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Jumlah Satuan</label>
                                            <input type="number" class="form-control" placeholder="" name="jumlah"
                                                required>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label>Satuan</label>
                                            <select id="inputState" class="default-select form-control wide"
                                                name="master_satuan_id" required>
                                                <option value="" selected>Pilih Satuan</option>
                                                <@foreach ($data['satuan'] as $row) <option value="{{$row->id}}">
                                                    {{$row->master_satuan_singkatan}} - {{$row->master_satuan_nama}}
                                                    </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>

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
            <!-- <h6>Info Jabatan</h6> -->
            <h6>Nama Jabatan : {{$data['kegiatanJabatan']->MKegiatanJabatan->kegiatan_jabatan_nama}}</h6>

            <div class="table-responsive">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Jenis Pembayaran</th>
                            <th>Honor</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['kegiatanBayarJabatanData'] as $index=> $row)
                        <tr class="text-center">
                            <td>{{$index+1}}</td>
                            <td>{{$row->mBayarKategori->bayar_nama}}</td>
                            <td>Rp.
                                {{number_format($row->kegiatanBayarJabatanAtur->honor, 0, ',','.')}}</td>
                            <td>{{$row->kegiatanBayarJabatanAtur->jumlah}}</td>
                            <td>
                                {{$row->kegiatanBayarJabatanAtur->masterSatuan->master_satuan_singkatan}} /
                                {{$row->kegiatanBayarJabatanAtur->masterSatuan->master_satuan_nama}}</td>
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
                                        <a class="dropdown-item"
                                            href="{{route('user.kegiatan.jabatan.bayar.setup.destroy',$row->id)}}"
                                            onclick="return confirm('Yakin Hapus? ini akan menghapus semua data terkait data yang dihapus')"><i
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

    </div>
</div>
@endsection

@section('js')
<script>
const locale = "de-DE";
const numberFormat = new Intl.NumberFormat(locale, {
    style: "decimal",
    maximumFractionDigits: 0,
    minimumFractionDigits: 0
});
const onlyChars = new RegExp(/^.$/)
const onlyNumbers = new RegExp(/\d/);
document.querySelector("#honor")
    .addEventListener("keydown", function(e) {
        if (onlyNumbers.test(e.key)) {
            e.preventDefault()
            e.target.value = numberFormat.format(e.target.value.replace(/\./g, '') + e.key)
        } else if (onlyChars.test(e.key) &&
            !e.getModifierState('Meta') &&
            !e.getModifierState('Ctrl')) {
            e.preventDefault()
        }
    });
</script>
@endsection