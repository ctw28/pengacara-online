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
        <a href="{{route('user.kegiatan.jabatan.peserta',[$data['kegiatan']->id,$data['kegiatanJabatan']->id])}}" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Anggota</h4>
        <button id="manage" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#basicModal">+
            Tambah Peserta Luar IAIN
            Anggota</button>
        <!-- Modal -->
        <div class="modal fade" id="basicModal">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Anggota Dari Luar IAIN Kendari</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">NIP <span class="required">*</span></label>
                                <input type="text" class="form-control" name="nip" id="nip" placeholder="Isikan NIP" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">NAMA LENGKAP <span class="required">*</span></label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="isikan Nama" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">GOLONGAN <span class="required">*</span></label>
                                <select name="golongan" id="golongan-list" class="form-control wide mb-4" required>
                                    <option>Pilih Golongan</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="add">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>
    <div class="modal-body">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-6">
                    <h4 class="card-title">Daftar Pegawai</h4>
                    <div class="row">
                        <div class="input-group input-group-sm my-3">
                            <input style="height: 45px;" type="text" class="form-control" id="cari-pegawai" name="q" placeholder="ketikkan Nama / NIP untuk pencarian">
                            <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <table class="table table-hover table-striped w-100">
                        <thead class="thead-info">
                            <tr>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>+</th>
                            </tr>
                        </thead>
                        <tbody id="list-pegawai">
                            <tr>
                                <td colspan="3" align="center">
                                    <i class="fa fa-circle-o-notch fa-spin"></i> Mohon Menunggu, sedang
                                    mengambil data Pegawai
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4 class="card-title">Daftar Anggota
                        {{$data['kegiatanJabatan']->mKegiatanJabatan->kegiatan_jabatan_nama}} (<span id="totalAnggota"></span> Anggota)
                    </h4>
                    <div class="row">
                        <div class="input-group input-group-sm my-3">
                            <input style="height: 45px;" type="text" class="form-control" name="q" placeholder="ketikkan Nama / NIP untuk pencarian">
                            <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <table class="table table-hover table-striped w-100">
                        <thead class="thead-success">
                            <tr>
                                <th>-</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                            </tr>
                        </thead>
                        <tbody id="list-anggota">

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

</div>

<template id="loader-data-anggota">
    <tr>
        <td colspan="5" align="center">
            <i class="fa fa-circle-o-notch fa-spin"></i> Mohon menunggu, sedang mengambil data anggota
            {{$data['kegiatanJabatan']->mKegiatanJabatan->kegiatan_jabatan_nama}}
        </td>
    </tr>
</template>
<template id="loader-data-anggota-modals">
    <tr>
        <td colspan="3" align="center">
            <i class="fa fa-circle-o-notch fa-spin"></i> Mohon menunggu, sedang mengambil data
            {{$data['kegiatanJabatan']->mKegiatanJabatan->kegiatan_jabatan_nama}}
        </td>
    </tr>
</template>
<template id="no-data">
    <tr>
        <td colspan="3" align="center">
            <b>Tidak Ada Data</b>
        </td>
    </tr>
</template>
<template id="no-data-peserta">
    <tr>
        <td colspan="4" align="center">
            <b>Tidak Ada Data</b>
        </td>
    </tr>
</template>
<template id="cari-data-peserta">
    <tr>
        <td colspan="3" align="center">
            <i class="fa fa-circle-o-notch fa-spin"></i> Mohon menunggu, sedang mencari data
        </td>
    </tr>
</template>
@endsection

@section('js')
<script>
    let listAnggota = getListAnggota()
    // setDataAnggota()
    // getListAnggota()
    async function getListAnggota() {
        const url = "{{route('user.kegiatan.jabatan.peserta.get',$data['kegiatanJabatan']->id)}}";
        let response = await fetch(url);
        let responseMessage = await response.json()
        console.log(responseMessage.data);
        return responseMessage.data
    }

    // async function getData() { //mengambil data dari simpeg sesuai data anggota yang terdaftar
    //     const url = "https://simpeg.iainkendari.ac.id/api/juara/get-data-pegawai";
    //     let dataSend = new FormData()
    //     console.log(await getListAnggota());
    //     if (await getListAnggota() == null)
    //         return null;
    //     dataSend.append('idpeg', JSON.stringify(await getListAnggota()))
    //     let response = await fetch(url, {
    //         method: "POST",
    //         body: dataSend
    //     });
    //     let responseMessage = await response.json()
    //     return responseMessage;
    // }

    // async function setDataAnggota() { //set data ke tabel anggota
    //     let responseMessage = await getData();
    //     let fragment = document.createDocumentFragment();
    //     const templateLoader = document.querySelector("#loader-data-anggota")
    //     const firstClone = templateLoader.content.cloneNode(true);
    //     const listPegawai = document.querySelector('#list-data-anggota');

    //     listPegawai.innerHTML = ""
    //     listPegawai.appendChild(firstClone)
    //     if (responseMessage == null) {
    //         const templateLoader2 = document.querySelector("#no-data-peserta")
    //         const firstClone2 = templateLoader2.content.cloneNode(true);
    //         listPegawai.innerHTML = ""
    //         listPegawai.appendChild(firstClone2);
    //         return
    //     }
    //     responseMessage.forEach(function(data, i) {
    //         let tr = document.createElement('tr');
    //         tr.className = 'insert'
    //         tr.dataset.id = data.idpeg
    //         let tdIndex = document.createElement('td');
    //         tdIndex.innerText = i + 1
    //         let tdNama = document.createElement('td');
    //         tdNama.innerText = data.nama
    //         let tdNip = document.createElement('td');
    //         tdNip.innerText = data.nip
    //         let tdGol = document.createElement('td');
    //         tdGol.innerText = ""
    //         tr.appendChild(tdIndex)
    //         tr.appendChild(tdNip)
    //         tr.appendChild(tdNama)
    //         tr.appendChild(tdGol)
    //         fragment.appendChild(tr);
    //     });
    //     listPegawai.innerHTML = ""
    //     listPegawai.appendChild(fragment);
    // }


    const listAnggotaContainer = document.querySelector('#list-anggota');
    async function setAnggota() {
        const templateLoader = document.querySelector("#loader-data-anggota-modals")
        const firstClone = templateLoader.content.cloneNode(true);
        const listPegawai = document.querySelector('#list-data-anggota');
        listAnggotaContainer.innerHTML = ""
        listAnggotaContainer.appendChild(firstClone)

        let fragmentAnggota = document.createDocumentFragment();
        let dataAnggota = await getListAnggota();

        if (dataAnggota == null) {
            const templateLoader2 = document.querySelector("#no-data")
            const firstClone2 = templateLoader2.content.cloneNode(true);
            listAnggotaContainer.innerHTML = ""
            listAnggotaContainer.appendChild(firstClone2);
            document.querySelector("#totalAnggota").innerText = 0
            return
        }
        dataAnggota.forEach(data => {
            let tr = document.createElement('tr');
            tr.className = 'insert'
            tr.dataset.id = data.idpeg
            let tdNama = document.createElement('td');
            tdNama.innerText = data.nama
            let tdNip = document.createElement('td');
            tdNip.innerText = data.nip
            let tdAct = document.createElement('td');
            let icon = document.createElement('i');
            icon.className = "fa fa-arrow-left text-danger"
            tdAct.appendChild(icon)
            tr.appendChild(tdAct)
            tr.appendChild(tdNip)
            tr.appendChild(tdNama)
            fragmentAnggota.appendChild(tr);
        });
        document.querySelector("#totalAnggota").innerText = dataAnggota.length;
        listAnggotaContainer.innerHTML = ""
        listAnggotaContainer.appendChild(fragmentAnggota);
    }

    listAnggotaContainer.addEventListener('click', async function(e) {
        console.log(e.target.closest('tr'))
        let confirm = false
        confirm = window.confirm("Yakin Keluarkan? ini akan menghapus semua data terkait data yang dihapus");
        if (confirm == true) {
            const url = "{{route('user.kegiatan.jabatan.peserta.destroy')}}";
            let dataSend = new FormData()
            dataSend.append('idpeg', e.target.closest('tr').dataset.id)
            dataSend.append('kegiatan_jabatan_id', "{{$data['kegiatanJabatan']->id}}")
            response = await fetch(url, {
                method: "POST",
                body: dataSend
            })
            responseMessage = await response.json()
            console.log(responseMessage);
            if (responseMessage.status) {
                listAnggotaContainer.removeChild(e.target.closest('tr'));
                setPegawai();
                setAnggota()

            } else {
                alert('gagal, coba lagi');
            }
        }
    });

    const listPegawaiContainer = document.querySelector('#list-pegawai');
    async function setPegawai() {
        let urlListPegawaiBukanAnggota = ''
        let fragment = document.createDocumentFragment();
        let dataSend = new FormData()
        // console.log(listAnggota);
        // if(await getListAnggota() == null) return listAnggotaContainer.innerHTML = ""
        let idPegawaiList = []
        let list = await getListAnggota();
        list.forEach(function(data) {
            idPegawaiList.push(data.idpeg);
        });
        if (idPegawaiList.length == 0)
            urlListPegawaiBukanAnggota = "https://simpeg.iainkendari.ac.id/api/juara/data-pegawai"
        else {
            urlListPegawaiBukanAnggota = "https://simpeg.iainkendari.ac.id/api/juara/get-data-pegawai-not-in";
            dataSend.append('idpeg', JSON.stringify(idPegawaiList))
        }

        let response = await fetch(urlListPegawaiBukanAnggota, {
            method: "POST",
            body: dataSend
        })
        let responseMessage = await response.json()
        console.log(responseMessage.length);
        responseMessage.forEach(function(data, i) {
            console.log(data);
            let tr = document.createElement('tr');
            tr.className = 'insert'
            tr.dataset.id = data.idpeg
            tr.dataset.nip = data.nip
            tr.dataset.nama = data.nama
            tr.dataset.golongan = data.gol
            tr.dataset.pajak = data.pajak
            let tdNama = document.createElement('td');
            tdNama.innerText = data.nama
            let tdNip = document.createElement('td');
            tdNip.innerText = data.nip
            let tdAct = document.createElement('td');
            let icon = document.createElement('i');
            icon.className = "fa fa-arrow-right text-success"
            tdAct.appendChild(icon)
            tr.appendChild(tdNip)
            tr.appendChild(tdNama)
            tr.appendChild(tdAct)
            fragment.appendChild(tr);
        });
        listPegawaiContainer.innerHTML = ""
        listPegawaiContainer.appendChild(fragment);

    }

    document.querySelector("#cari-pegawai").addEventListener("change", async function(e) {

        console.log("masuk");
        const templateLoader = document.querySelector("#cari-data-peserta")
        const firstClone = templateLoader.content.cloneNode(true);

        listPegawaiContainer.innerHTML = ""
        listPegawaiContainer.appendChild(firstClone)
        let fragment = document.createDocumentFragment();
        let dataSend = new FormData()
        dataSend.append('q', e.target.value)
        // dataSend.append('idpeg', JSON.stringify(await getListAnggota()))
        response = await fetch('https://simpeg.iainkendari.ac.id/api/juara/search', {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()
        console.log(responseMessage);
        responseMessage.forEach(function(data, i) {
            let tr = document.createElement('tr');
            tr.className = 'insert'
            tr.dataset.id = data.idpeg
            tr.dataset.nip = data.nip
            tr.dataset.nama = data.nama
            tr.dataset.golongan = data.gol
            tr.dataset.pajak = data.pajak

            let tdNama = document.createElement('td');
            tdNama.innerText = data.nama
            let tdNip = document.createElement('td');
            tdNip.innerText = data.nip
            let tdAct = document.createElement('td');
            let icon = document.createElement('i');
            icon.className = "fa fa-arrow-right text-success"
            tdAct.appendChild(icon)
            tr.appendChild(tdNip)
            tr.appendChild(tdNama)
            tr.appendChild(tdAct)
            fragment.appendChild(tr);
        });
        listPegawaiContainer.innerHTML = ""
        listPegawaiContainer.appendChild(fragment);
        // console.log(responseMessage);

    });


    listPegawaiContainer.addEventListener('click', async function(e) {
        // alert(e.target.closest('tr').dataset.id)
        const url = "{{route('user.kegiatan.jabatan.peserta.store')}}";
        let dataSend = new FormData()
        dataSend.append('idpeg', e.target.closest('tr').dataset.id)
        dataSend.append('nip', e.target.closest('tr').dataset.nip)
        dataSend.append('nama', e.target.closest('tr').dataset.nama)
        dataSend.append('golongan', e.target.closest('tr').dataset.golongan)
        dataSend.append('pajak', e.target.closest('tr').dataset.pajak)
        dataSend.append('kegiatan_jabatan_id', "{{$data['kegiatanJabatan']->id}}")
        dataSend.append('is_iain', "1")
        response = await fetch(url, {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()
        console.log(responseMessage);
        if (responseMessage.status) {
            listPegawaiContainer.removeChild(e.target.closest('tr'));
            setAnggota();
        } else {
            alert('ada kesalahan, coba lagi');
        }
    });


    setPegawai();
    setAnggota();
    const manage = document.querySelector('#manage');
    manage.addEventListener('click', async function(e) {
        const url = "https://simpeg.iainkendari.ac.id/api/juara/get-golongan"
        const urlSave = "{{route('user.kegiatan.jabatan.peserta.store')}}";

        response = await fetch(url)
        responseMessage = await response.json()

        let fragment = document.createDocumentFragment();
        let optionGolongan = document.querySelector('#golongan-list')
        responseMessage.forEach(data => {
            // console.log(data);
            let option = document.createElement('option');
            option.innerText = `${data.gol} / ${data.pangkat}`
            option.value = data.gol
            option.dataset.pajak = data.pajak
            fragment.appendChild(option);
        });
        optionGolongan.append(fragment);


        const add = document.querySelector('#add');
        add.addEventListener('click', async function(e) {
            let nip = document.querySelector("#nip")
            let nama = document.querySelector("#nama")
            let golongan = document.querySelector("#golongan-list")
            let dataSend = new FormData()
            if (nip.value == '' || nama.value == '' || golongan.value == '')
                return alert("tidak boleh kosong")
            // return console.log(golongan.options[golongan.selectedIndex].dataset.pajak);
            dataSend.append('idpeg', nip.value)
            dataSend.append('nip', nip.value)
            dataSend.append('nama', nama.value)
            dataSend.append('golongan', golongan.options[golongan.selectedIndex].value)
            dataSend.append('pajak', golongan.options[golongan.selectedIndex].dataset.pajak)
            dataSend.append('kegiatan_jabatan_id', "{{$data['kegiatanJabatan']->id}}")
            dataSend.append('is_iain', "0")
            response = await fetch(urlSave, {
                method: "POST",
                body: dataSend
            })
            responseMessage = await response.json()
            if (responseMessage.status) {
                alert('Berhasil Tambah Data');
                $('#basicModal').modal('hide');

                setAnggota();
            } else {
                alert('ada kesalahan, coba lagi');
            }
        });

        // console.log(responseMessage);
    });
</script>

@endsection