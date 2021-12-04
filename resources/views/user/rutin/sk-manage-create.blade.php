@extends('template')

@section('content')
<div class="col-xl-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Pejabat</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{route('referensi.jabatan.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Jabatan <span class="required">*</span></label>
                            <select class="form-control" name="rutin_jabatan_id">
                                <option value="">Pilih Jabatan</option>
                                @foreach($data['masterJabatan'] as $row)
                                <option value="{{$row->id}}">{{$row->jabatan_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label>Pilih Pegawai</label>
                            <div class="mb-3">
                                <select class="form-control" name="" id="pegawai-list">
                                    <option value="">Pilih Pegawai</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label>Honor</label>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="honor" placeholder="Tuliskan Jumlah Honor" required>

                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    getPegawaiList()
    async function getPegawaiList() {
        let response = await fetch('https://simpeg.iainkendari.ac.id/api/juara/data-pegawai')
        let responseMessage = await response.json()
        let fragment = document.createDocumentFragment();
        let optionPeserta = document.querySelector('#pegawai-list')
        // console.log(optionPeserta);
        responseMessage.forEach(data => {
            // console.log(data);
            let option = document.createElement('option');
            option.innerText = `${data.nip} - ${data.nama}`
            option.value = data.idpeg
            optionPeserta.appendChild(option);
        });
        optionPeserta.append(fragment);

    }
</script>
@endsection