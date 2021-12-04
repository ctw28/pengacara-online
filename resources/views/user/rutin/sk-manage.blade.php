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
        <h4 class="">Info Surat Keputusan:</h4>
        <p>{{$data['dataSK']->sk}}</p>
        <a href="{{route('rutin.sk.index')}}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Daftar Pejabat</h4>
        <a href="{{route('rutin.sk.manage.create',$data['dataSK']->id)}}" class="btn btn-info">Tambah
            Pejabat</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-responsive-sm">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Jabatan</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Pajak</th>
                        <th>Golongan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="list-data-anggota" class="text-center">
                    @foreach($data['dataPejabat'] as $index => $row)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->rutinJabatan->jabatan_nama}}</td>
                        <td>{{$row->nip}}</td>
                        <td>{{$row->nama}}</td>
                        <td>{{$row->pajak}}</td>
                        <td>{{$row->golongan}}</td>
                        <td>Hapus</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection