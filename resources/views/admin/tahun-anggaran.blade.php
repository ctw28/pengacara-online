@extends('template')


@section('css')
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Tahun Anggaran</h4>
            <a href="{{route('admin.tahun.anggaran.tambah')}}" class="btn btn-primary">
                <i class="fa fa-plus color-primary"></i>
                Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive-sm">
                    <thead class="thead-primary">
                        <tr>
                            <th>#</th>
                            <th>Tahun Anggaran</th>
                            <th>Sebutan</th>
                            <th>Bendahara Pengeluaran</th>
                            <th>Tanggal/No. Dipa</th>
                            <th>Atur Fakultas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data['dataTahunAnggaran'] as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->tahunAnggaran->tahun_anggaran}}</td>
                            <td>{{$item->tahunAnggaran->tahun_anggaran_sebutan}}</td>
                            <td>{{$item->pengaturanJabatan->idpeg}}</td>
                            <td>{{$item->tahunAnggaran->tahunAnggaranDipa->dipa_tgl}} /
                                {{$item->tahunAnggaran->tahunAnggaranDipa->dipa_nomor}}</td>
                            <td>
                                <a href="{{route('admin.set.fakultas',$item->id)}}"
                                    class="btn btn-light btn-xs">Atur</a>
                                <!-- Modal -->
                                <!-- <div class="modal fade" id="basicModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Pengaturan Pejabat Fakultas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <label class="form-label">Pilih Fakultas</label>
                                                    <select id="fakultas" name="fakultas"
                                                        class="default-select form-control wide select2">
                                                        <option selected>Pilih Fakultas</option>
                                                    </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Lanjut</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown"
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
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </td>
                            <!-- <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                            class="fa fa-trash"></i></a>
                                </div>
                            </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /# card -->
</div>
@endsection
@section('js')
<!-- 
<script>
getFakultas();
async function getFakultas() {
    let response = await fetch("{{route('api.fakultas')}}");
    let select = document.querySelector('#fakultas')
    let responseMessage = await response.json()
    console.log(responseMessage)
    responseMessage.forEach(data => {

        let opt = document.createElement('option')
        opt.value = data.id
        opt.innerHTML = data.singkatan + " - " + data.fakultas_nama
        select.appendChild(opt)
    });
}
</script> -->
@endsection