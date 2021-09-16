@extends('template')

@section('css')
<style>
.insert {
    cursor: pointer;
}
</style>
@endsection
@section('content')
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
        <h4 class="card-title">Data Anggota</h4>
        <a href="{{route('user.kegiatan.jabatan.peserta.add',[$data['kegiatan']->id,$data['kegiatanJabatan']->id])}}"
            class="btn btn-info">Manage
            Anggota</a>
    </div>
    <div class="card-body">
        <h4 class="">Info Jabatan:</h4>
        <p>{{$data['kegiatanJabatan']->mKegiatanJabatan->kegiatan_jabatan_nama}}</p>
        <div class="table-responsive">
            <table class="table table-responsive-sm">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Golongan</th>
                    </tr>
                </thead>
                <tbody id="list-data-anggota" class="text-center">
                    @foreach($data['dataPeserta'] as $index => $row)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->nip}}</td>
                        <td>{{$row->nama}}</td>
                        <td>{{$row->golongan}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection