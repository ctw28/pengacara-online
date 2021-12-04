@extends('template')

@section('content')

<div class="col-xl-12">
    <div class="card">
        <div class="card-header d-block d-sm-flex border-0">
            <div class="me-3">
                <h4 class="card-title mb-2">Daftar Surat Keterangan (SK)</h4>
                <!-- <span class="fs-12">Lorem ipsum dolor sit amet, consectetur</span> -->
            </div>
            <div class="card-tabs mt-3 mt-sm-0">
                <a href="{{route('rutin.sk.create')}}" class="btn btn-secondary btn-sm">+ Tambah Data</a>
                <!-- <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                    </li>
                </ul> -->
            </div>
        </div>
        <div class="card-body tab-content p-0">
            <div class="table-responsive">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>SK</th>
                            <th>Tanggal SK</th>
                            <th>Sub Kegiatan</th>
                            <th>No. Bukti</th>
                            <th>Akun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="list-data-anggota" class="text-center">
                        @foreach($data['dataSK'] as $index => $row)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$row->sk}}</td>
                            <td>{{$row->sk_tanggal}}</td>
                            <td>{{$row->sub_kegiatan}}</td>
                            <td>{{$row->no_bukti}}</td>
                            <td>{{$row->akun}}</td>
                            <td>
                                <div>
                                    <a href="{{route('rutin.sk.manage',$row->id)}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-gear"></i></a>
                                    <a href="{{route('rutin.sk.edit',$row->id)}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('rutin.sk.delete',$row->id)}}" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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