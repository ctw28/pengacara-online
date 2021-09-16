@extends('template')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="">Info Kegiatan:</h4>
        <p>{{$data['kegiatan']->kegiatan_nama}}</p>
        <h4 class="">Sesi Pembayaran:</h4>
        <p>Tanggal Pembayaran :
            {{\Carbon\Carbon::parse($data['pembayaran']->kegiatan_pembayaran_tanggal)->format('d M Y')}}
            <br>Penerima : {{$data['pembayaran']->kegiatanPeserta->nama}}
        </p>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <h4 class="card-title">Ampra</h4>
        <div class="table-responsive">
            <table class="table table-responsive-sm">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Jabatan</th>
                        <th>Jenis Pembayaran</th>
                        <!-- <th>Total Pembayaran</th> -->
                        <th>Cetak</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($data['pembayaranSesi'] as $index => $row)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->kegiatanBayarJabatan->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama}}
                        </td>
                        <td>{{$row->kegiatanBayarJabatan->mBayarKategori->bayar_nama}}</td>
                        <!-- <td>Rp. xxxxxxxxxx </td> -->
                        <td><a class="btn btn-warning btn-xs"
                                href="{{route('kegiatan.ampra.print',[$data['kegiatan']->id,$data['pembayaran']->id, $row->id])}}"><i
                                    class="fa fa-print"></i>
                                Cetak Ampra</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h4 class="card-title">Dokumen Lainnya</h4>
        <div class="table-responsive">
            <table class="table table-responsive-sm">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Dokumen</th>
                        <th>Cetak</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($data['listDokumen'] as $index => $row)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row['nama']}}</td>
                        <td><a class="btn btn-warning btn-xs"
                                href="{{route('kegiatan.print.dokumen',[$data['kegiatan']->id,$data['pembayaran']->id,$row['alias']])}}"><i
                                    class="fa fa-print"></i>
                                Cetak</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection