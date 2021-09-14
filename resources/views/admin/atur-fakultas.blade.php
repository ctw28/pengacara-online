@extends('template')

@section('css')
<link rel="stylesheet" href="{{asset('/')}}vendor/select2/css/select2.min.css">
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Fakultas</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive-sm">
                    <thead class="thead-primary">
                        <tr>
                            <th style="width:5%">#</th>
                            <th style="width:35%">Nama Fakultas</th>
                            <th style="width:60%">PPK</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data['dataFakultas'] as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->singkatan}} - {{$item->fakultas_nama}}</td>
                            <td>
                                <select data-fakultas="{{$item->id}}" name="idpeg" id="fakultas_{{$item->id}}"
                                    class="js-data-example-ajax w-100 idpeg">
                                    <option>Pilih PPK</option>
                                    @foreach ($pegawai as $item2)
                                    <option value="{{$item2['idpeg']}}" 
                                        @foreach ($data['dataPengaturanJabatanFakultas'] as $row) 
                                            @if($row->master_fakultas_id == $item->id && $row->pengaturanJabatan->idpeg==$item2['idpeg'])
                                                {{"selected"}}
                                            @endif
                                        @endforeach
                                        >{{$item2['nip']}} - {{$item2['nama']}}</option>
                                    @endforeach
                                </select>
                            </td>
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
<script src="{{asset('/')}}vendor/select2/js/select2.full.min.js"></script>
<script>
$(document).ready(function() {
    $(".js-data-example-ajax").select2().on('select2:select', function(e) {
        // return console.log(e.target.dataset.fakultas);
        save()
        async function save() {
            let dataSend = new FormData()
            dataSend.append('idpeg', e.target.value)
            dataSend.append('tahun_anggaran_pengaturan_id', window.location.pathname.split('/')[3])
            dataSend.append('master_fakultas_id', e.target.dataset.fakultas)
            let response = await fetch("{{route('admin.save.pejabat.fakultas')}}", {
                method: "POST",
                body: dataSend
            })
            let responseMessage = await response.json()
            console.log(responseMessage);
        }
    });;
    // $('.js-data-example-ajax2').

    const selectElement = document.querySelector('#fakultas_1');

    selectElement.addEventListener('change', (event) => {
        alert('adgas')
    });
});
</script>
@endsection