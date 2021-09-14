@extends('template')

@section('content')
<div class="card-bx bg-blue">
    <img class="pattern-img" src="{{asset('/')}}images/pattern/pattern6.png" alt="">
    <div class="card-info text-white" style="padding:0">
        <!-- <img src="{{asset('/')}}images/pattern/circle.png" alt=""> -->
        <h3 class="text-yellow card-balance">{{$data['kegiatan']->kegiatan_nama}}</h3>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">Daftar Sesi Pembayaran</h4>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#basicModal">
            + Tambah Sesi Pembayaran</button>
        <!-- Modal -->
        <div class="modal fade" id="basicModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Tambah Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('user.kegiatan.bayar.store',$data['kegiatan']->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="kegiatan_id" value="{{$data['kegiatan']->id}}">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Tanggal Pembayaran <span class="required">*</span></label>
                                    <input type="date" class="form-control" name="kegiatan_pembayaran_tanggal">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Tanggal Lunas</label>
                                    <input type="date" class="form-control" name="kegiatan_pembayaran_tanggal_lunas">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Penerima <span class="required">*</span></label>
                                    <select name="kegiatan_peserta_id" id="peserta-list" class="form-control wide mb-4"
                                        required>
                                        <option>Pilih Penerima</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Pembayaran</button>
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
                        <th>Tanggal Pembayaran</th>
                        <th>Penerima</th>
                        <th>Tanggal Lunas</th>
                        <th>Detail</th>
                        <th>Aksi / Cetak</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data['pembayaran'] as $key=>$item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{\Carbon\Carbon::parse($item->kegiatan_pembayaran_tanggal)->format('d M Y')}}</td>
                        <td><span id="penerima_{{$item->kegiatanPeserta->idpeg}}"></span></td>
                        <td>{{\Carbon\Carbon::parse($item->kegiatan_pembayaran_tanggal_lunas)->format('d M Y')}}</td>
                        <td><a class="btn btn-info btn-xs"
                                href="{{route('kegiatan.ampra.index',[$data['kegiatan']->id,$item->id])}}"><i
                                    class="fa fa-gear"></i>
                                Pembayaran Ampra</a></td>
                        </td>
                        <td><a class="btn btn-warning btn-xs"
                                href="{{route('kegiatan.print',[$data['kegiatan']->id,$item->id])}}"><i
                                    class="fa fa-print"></i>
                                Cetak Dokumen Pembayaran</a></td>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@section('js')
<script>
setOptionPeserta()
async function getListPeserta() {
    let idPeserta = []
    response = await fetch('{{route("kegiatan.peserta.all", $data["kegiatan"]->id)}}')
    responseMessage = await response.json()
    responseMessage.forEach(function(data) {
        idPeserta.push(data.idpeg);
    });
    if (idPeserta.length == 0)
        return null;
    return idPeserta
}

async function setOptionPeserta() {
    let dataSend = new FormData()
    dataSend.append('idpeg', JSON.stringify(await getListPeserta()))
    let response = await fetch('https://simpeg.iainkendari.ac.id/api/juara/get-data-pegawai', {
        method: "POST",
        body: dataSend
    })
    let responseMessage = await response.json()
    let fragment = document.createDocumentFragment();
    let optionPeserta = document.querySelector('#peserta-list')
    // console.log(optionPeserta);
    responseMessage.forEach(data => {
        // console.log(data);
        let option = document.createElement('option');
        option.innerText = `${data.nip} - ${data.nama}`
        option.value = data.idpeg
        optionPeserta.appendChild(option);
    });
    // optionPeserta.append(fragment);
}

setPenerima()
async function getAnggota() {
    const url = "{{route('penerima.get',$data['kegiatan']->id)}}";
    let idPegawaiList = []
    let response = await fetch(url);
    let responseMessage = await response.json()
    responseMessage.forEach(function(data) {
        idPegawaiList.push(data.kegiatan_peserta.idpeg);
    });
    console.log(responseMessage);
    return idPegawaiList
}

async function setPenerima() { //mengambil data dari simpeg sesuai data anggota yang terdaftar
    const url = "https://simpeg.iainkendari.ac.id/api/juara/get-data-pegawai";
    let dataSend = new FormData()
    dataSend.append('idpeg', JSON.stringify(await getAnggota()))
    let response = await fetch(url, {
        method: "POST",
        body: dataSend
    });
    let responseMessage = await response.json()
    console.log(responseMessage);
    responseMessage.map(function(data) {
        document.querySelector(`#penerima_${data.idpeg}`).innerText = data.nama
    });
}
</script>
@endsection