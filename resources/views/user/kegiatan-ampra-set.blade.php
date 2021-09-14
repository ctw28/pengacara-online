@extends('template')

@section('content')
<div class="card-bx bg-blue">
    <img class="pattern-img" src="{{asset('/')}}images/pattern/pattern6.png" alt="">
    <div class="card-info text-white" style="padding:0">
        <!-- <img src="{{asset('/')}}images/pattern/circle.png" alt=""> -->
        <h3 class="text-yellow card-balance">{{$data['kegiatan']->kegiatan_nama}}</h3>
        <span class="fs-18">Sesi Pembayaran :
            {{\Carbon\Carbon::parse($data['pembayaran']->kegiatan_pembayaran_tanggal)->format('d M Y')}}</span>
        <br><span class="fs-18">Untuk Pembayaran :
            {{$data['pembayaranJenis']->kegiatanBayarJabatan->mBayarKategori->bayar_nama}}
            ({{$data['pembayaranJenis']->kegiatanBayarJabatan->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama}})
        </span>
    </div>
</div>


<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">List Pembayaran</h4>
        <h4 class="badge badge-rounded badge-primary badge-xl">Total Pembayaran : Rp.
            <span id="total">{{number_format($data['total'], 0, ',','.')}}</span>
        </h4>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="{{route('kegiatan.ampra.store')}}" method="post">
                @csrf
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Golongan</th>
                            <th>Jabatan</th>
                            <th>Jumlah Honor</th>
                            @if($data['pajak']==true)
                            <th>Pajak</th>
                            @endif
                            <th>diterima</th>
                            <th>Norek</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody id="list-data-anggota" class="text-center">
                        @foreach($data['peserta'] as $index => $row)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td class="text-start">{{$row->nama}}
                                <input type="hidden" name="data[{{$index}}][kegiatan_pembayaran_sesi_id]"
                                    value="{{$data['sesiId']}}">
                                <input type="hidden" name="data[{{$index}}][kegiatan_peserta_id]" value="{{$row->id}}">
                            </td>
                            <td>{{$row->golongan}}</td>
                            <td>{{$row->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama}}</td>
                            <td>
                                <span>
                                    Rp.
                                    <input style="width:90px" class="text-center honor" type="text" data-jenis="honor"
                                        name="data[{{$index}}][honor]"
                                        value="{{number_format($data['pembayaranJenis']->honor, 0, ',','.')}}">
                                    x
                                    <input style="width:35px" class="text-center jumlah" type="text" data-jenis="jumlah"
                                        name="data[{{$index}}][jumlah]" value="{{$data['pembayaranJenis']->jumlah}}">
                                    <input type="hidden" value="{{$data['pembayaranJenis']->masterSatuan->id}}"
                                        name="data[{{$index}}][master_satuan_id]">
                                    {{$row->satuan}} = Rp.
                                </span>
                                <span class="total-honor">{{number_format($row->total, 0, ',','.')}}</span>
                            </td>

                            @if($data['pajak']==true)
                            <td data-persen-pajak="{{$row->pajak}}">{{number_format($row->pajak_potong,0, ',','.')}}
                                <input type="hidden" value="{{$row->pajak_potong}}" name="data[{{$index}}][pajak]">
                            </td>
                            @endif


                            <td class="terima">Rp. <span>{{number_format($row->terima, 0, ',','.')}}</span>
                            </td>
                            <td>Terlampir</td>
                            <!-- <td><a href="#" onclick="return confirm('Yakin Keluarkan dari pembayaran?')"><i
                                    class="las la-times-circle text-danger scale5 me-3"></i></a></td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
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
let input = document.querySelectorAll("input[type='text']")
let totalHonor = document.querySelectorAll(".total-honor")

for (let i = 0; i < input.length; i++) {
    input[i].addEventListener("input", function(e) {
        let value = (e.target.value).replace(/\D/g, '');
        // let value
        // if (e.key == "Backspace" || e.key == "Delete")
        //     value = (e.target.value).replace(/\D/g, '');
        // else
        //     value = (e.target.value + e.key).replace(/\D/g, '');

        console.log(`value = ${value}, key = ${e.key}`);
        let kali = (e.target.dataset.jenis == "honor") ? e.target.nextElementSibling.value.replace(/\./g,
                '') :
            e.target
            .previousElementSibling.value.replace(/\./g, '');
        // e.target.parentNode.nextElementSibling.innerText =
        let totalKali = e.target.parentNode.nextElementSibling.innerText = numberFormat.format(String(
            parseFloat(value) *
            parseFloat(kali)).replace(/\./g, ''))

        let grandTotal = 0;
        for (var i = 0; i < totalHonor.length; i++) {
            grandTotal = grandTotal + parseFloat(totalHonor[i].innerText.replace(/\./g, ''));
        }
        var getNextSibling = function(elem, selector) {

            // Get the next sibling element
            var sibling = elem.nextElementSibling;

            // If there's no selector, return the first sibling
            if (!selector) return sibling;

            // If the sibling matches our selector, use it
            // If not, jump to the next sibling and continue the loop
            while (sibling) {
                if (sibling.matches(selector)) return sibling;
                sibling = sibling.nextElementSibling
            }

        };
        document.querySelector("#total").innerText = numberFormat.format(String(grandTotal).replace(/\./g,
            ''))
        let isPajak = "{{$data['pajak']}}"
        if (isPajak == "1") {
            let pajak = getNextSibling(e.target.closest('td'))
            console.log(pajak);
            // console.log(pajak.firstElementChild.value);
            let nextElement = getNextSibling(e.target.closest('td').nextElementSibling, '.terima')
                .firstElementChild;
            let persenPajak = getNextSibling(e.target.closest('td')).dataset.persenPajak
            let jumlahPotonganPajak = getNextSibling(e.target.closest('td'));
            // console.log(jumlahPotonganPajak);
            let pajakTotal = pajak.firstChild.data.replace(/\D/g, '');
            let tot = totalKali.replace(/\./g, '');
            console.log(`tot = ${tot}`);
            let hasil = persenPajak / 100 * tot
            jumlahPotonganPajak.firstChild.data = numberFormat.format(hasil)
            // console.log(totalKali);
            console.log(`total pajak = ${pajakTotal}, firsct chi = ${pajak.firstChild.data}`);
            // 
            nextElement.innerText = numberFormat.format(tot - hasil);
            pajak.firstElementChild.value = hasil;
        } else {
            e.target.closest('td').nextElementSibling.firstElementChild.innerText = totalKali
        }
        e.target.value = numberFormat.format(e.target.value.replace(/\D/g, ''))
        if (onlyChars.test(e.key) &&
            !e.getModifierState('Meta') &&
            !e.getModifierState('Ctrl')) {
            e.preventDefault()
        }
    });
}

// setAnggota()
// async function getAnggota() {
//     const url = "{{route('peserta.get')}}";
//     let idPegawaiList = []
//     let dataSend = new FormData()
//     dataSend.append('id', "{{$data['pembayaran']->kegiatan_peserta_id}}")
//     let response = await fetch(url, {
//         method: "POST",
//         body: dataSend
//     });
//     let responseMessage = await response.json()
//     idPegawaiList.push(responseMessage.idpeg);
//     return idPegawaiList
// }

// async function setPenerima() { //mengambil data dari simpeg sesuai data anggota yang terdaftar
//     const url = "https://simpeg.iainkendari.ac.id/api/juara/get-data-pegawai";
//     let dataSend = new FormData()
//     dataSend.append('idpeg', JSON.stringify(await getAnggota()))
//     let response = await fetch(url, {
//         method: "POST",
//         body: dataSend
//     });
//     let responseMessage = await response.json()
//     console.log(responseMessage);
//     document.querySelector("#penerima").innerText = `${responseMessage[0].nama} (${responseMessage[0].nip})`
// }


// setNama() //ini untuk set nama2 pegawai ambil dari simpeg
// async function getNama() { //ini untuk dapat list idpeg nya
//     const url = "{{route('get.peserta.per-sesi-pembayaran',$data['sesiId'])}}";
//     let idPegawaiList = []
//     let response = await fetch(url);
//     let responseMessage = await response.json()
//     responseMessage.peserta.map(function(data) {
//         idPegawaiList.push(data.idpeg);
//     });
//     console.log(idPegawaiList);
//     return idPegawaiList
// }

// async function setNama() { //mengambil data dari simpeg sesuai data anggota yang terdaftar
//     const url = "https://simpeg.iainkendari.ac.id/api/juara/get-data-pegawai";
//     let dataSend = new FormData()
//     dataSend.append('idpeg', JSON.stringify(await getNama()))
//     let response = await fetch(url, {
//         method: "POST",
//         body: dataSend
//     });
//     let responseMessage = await response.json()
//     console.log(responseMessage);
//     responseMessage.map(function(data) {
//         document.querySelector(`#nama_${data.idpeg}`).innerText = data.nama
//         document.querySelector(`#golongan_${data.idpeg}`).innerText = data.gol
//     });
// }
</script>
@endsection