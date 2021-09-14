<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK SURAT PERNYATAAN TANGGUNG JAWAB BELANJA </title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
    @page {
        size: 21cm 29.7cm lanscape;
        /* A4 size */
        margin: 1cm 2cm 1cm 2cm;
        /* this affects the margin in the printer settings */
    }

    @media all {

        body,
        table {
            background-color: #FFFFFF;
            color: #000;
            font-size: medium;
        }

        .page-break {
            display: none;
            display: block;
            page-break-after: always;
        }

        .text-center {
            text-align: center;
            margin: 0 auto;
        }

        .text-justify {
            text-align: justify;
        }

        .text-up {
            vertical-align: top;
        }

        .trapezium {
            transform: skew(-20deg);
            border: 1px solid #000
        }
    }
    </style>
</head>
<!--
<body onload="window.print()" onfocus="window.close()">
-->

<body>

    <div style="width:29.7cm;margin:0 auto;">

        <!--TITLE-->
        <h2 class="text-center"><u>SURAT PERNYATAAN TANGGUNG JAWAB BELANJA</u></h2>
        <h3 class="text-center">NOMOR : &nbsp; &nbsp;&nbsp; &nbsp;/FEBI/SPTJB-DIPA IAIN/&nbsp; &nbsp;&nbsp; &nbsp;/2021
        </h3>

        <br />
        <!--TITLE END-->


        <table border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width:4.5cm">1. Kode Satuan Kerja</td>
                    <td style="width:0.5cm">:</td>
                    <td style="width:24.7cm">307665</td>
                </tr>
                <tr>
                    <td>2. Nama Satuan Kerja</td>
                    <td>:</td>
                    <td>Institut Agama Islam Negeri Kendari</td>
                </tr>
                <tr>
                    <td>3. Tanggal / No. DIPA</td>
                    <td>:</td>
                    <td>{{$data['dipa']->dipa_tgl}}/ {{$data['dipa']->dipa_nomor}}</td>
                </tr>
                <tr>
                    <td>4. Klasifikasi Anggaran</td>
                    <td>:</td>
                    <td>{{$data['kegiatan'][0]->kegiatan_sub_kegiatan}}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom:2px solid #000">&nbsp;</td>
                </tr>
            </tbody>
        </table>

        <p class="text-justify">
            Yang bertanda tangan dibawah ini atas nama Kuasa Pengguna Anggaran Satuan Kerja IAIN Kendari menyatakan
            bahwa saya
            bertanggung jawab secara formal dan material dan kebenaran perhitungan pemungutan pajak atas segala
            pembayaran tagihan yang
            telah kami perintahkan dalam SPM ini dengan perincian sebagai berikut :
        </p>

        <table border="1" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th style="width:1cm" rowspan="2">No.</th>
                    <th style="width:1.5cm" rowspan="2">Akun</th>
                    <th style="width:4.5cm" rowspan="2">Penerima</th>
                    <th style="width:19.2cm" rowspan="2">Uraian</th>
                    <th style="width:3cm" rowspan="2">Jumlah</th>
                    <th style="width:6cm" colspan="2">Pajak yang dipungut</th>
                </tr>
                <tr>
                    <th style="width:3cm">PPN</th>
                    <th style="width:3cm">PPh</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>{{$data['kegiatan'][0]->kegiatan_akun}}</td>
                    <td>{{$data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatanPeserta->nama}}</td>
                    <td class="text-justify">
                        Pembayaran
                        @foreach($data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatanPembayaranSesi as $index=> $row)
                        {{$row->kegiatanBayarJabatan->mBayarKategori->bayar_nama}}
                        {{$row->kegiatanBayarJabatan->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama}}
                        @if(count($data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatanPembayaranSesi) -2 > $index)
                        {{","}}
                        @endif
                        @if(count($data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatanPembayaranSesi) -2 == $index)
                        dan
                        @endif
                        @endforeach
                        {{$data['kegiatan'][0]->kegiatan_nama}}.
                    </td>
                    <td class="text-center">
                        {{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->total_keseluruhan, 0, ',','.')}}
                    </td>
                    <td class="text-center">
                        {{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->pajak, 0, ',','.')}}</td>
                    <td class="text-center">
                        {{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->total_terima, 0, ',','.')}}</td>
                </tr>
            </tbody>
            <tfooter>
                <tr>
                    <th colspan="4">Jumlah</th>
                    <th>{{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->total_keseluruhan, 0, ',','.')}}
                    </th>
                    <th>{{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->pajak, 0, ',','.')}}</th>
                    <th>{{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->total_terima, 0, ',','.')}}</th>
                </tr>
            </tfooter>
        </table>

        <p class="text-justify">
            Bukti-bukti pengeluaran anggaran dan asli setoran pajak (SSP/BPN) Tersebut diatas disimpan oleh Pengguna
            Anggaran/Kuasa Pengguna Anggaran Untuk Kelengkapan administrasi dan pemeriksaan aparat pengawasan
            fungsional.
        </p>
        <p class="text-justify">
            Demikian Surat Pernyataan ini dibuat dengan sebenarnya.
        </p>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:9.5cm">
                    </td>
                    <td style="width:9.5cm">
                    </td>
                    <td style="width:10.7cm">
                        Kendari, {{$data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatan_pembayaran_tanggal}},<br />
                        Pejabat Pembuat Komitmen
                    </td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Dr.s Musdin</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>NIP. 19692472645724</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>