<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Cetak Kwitansi</title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
    @page {
        size: 21cm 29.7cm portrait;
        /* A4 size */
        margin: 1cm 2cm 1cm 2cm;
        /* this affects the margin in the printer settings */
    }

    @media all {
        body {
            background-color: #FFFFFF;
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

<body style="color:#000;font-size:12;">

    <div style="width:21cm;margin:0 auto;">

        <!--KOP-->
        <table border="0" cellpadding="1" cellspacing="1" style="width:100%;" class="text-center">
            <tr>
                <td style="text-align: center; vertical-align: middle; width: 15%;">
                    <img src="https://simpeg.iainkendari.ac.id/./upload/logo/49sqk.png" style="width: 70px;" />
                </td>
                <td style="vertical-align: top; width: 70%;"><strong>
                        <span style="font-size:18">KEMENTERIAN AGAMA REPUBLIK INDONESIA</span><br />
                        <span style="font-size:17">INSTITUT AGAMA ISLAM NEGERI (IAIN) KENDARI</span></strong><br />
                    <span style="font-size:12">
                        Jl. Sultan Qaimuddin No. 17, Telp (0401) 3192081 Fax (0401) 3193710<br />
                        Email : humas@iainkendari.ac.id, Website : iainkendari.ac.id
                    </span>
                </td>
                <td style="text-align: center; vertical-align: middle; width: 15%;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center; vertical-align: top;border-top:2px #000 solid;">&nbsp;</td>
            </tr>
        </table>
        <!--KOP END-->

        <!--TITLE-->
        <h2 class="text-center">KWITANSI</h2><br />
        <br />
        <!--TITLE END-->


        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:3.5cm">Sub Kegiatan</td>
                    <td style="width:0.5cm">:</td>
                    <td style="width:16cm">{{$data['kegiatan'][0]->kegiatan_sub_kegiatan}}</td>
                </tr>
                <tr>
                    <td>Akun</td>
                    <td>:</td>
                    <td>{{$data['kegiatan'][0]->kegiatan_akun}}</td>
                </tr>
                <tr>
                    <td>No. Bukti</td>
                    <td>:</td>
                    <td>{{$data['kegiatan'][0]->kegiatan_nomor_bukti}}</td>
                </tr>
                <tr>
                    <td>Telah Terima Dari</td>
                    <td>:</td>
                    <td>Kuasa Pengguna Anggaran IAIN Kendari</td>
                </tr>
                <tr>
                    <td class="text-up">Uang Sejumlah</td>
                    <td>:</td>
                    <td style="border:1px solid #000">Rp
                        {{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->total_keseluruhan, 0, ',','.')}}
                    </td>
                </tr>
                <tr>
                    <td class="text-up">Untuk Pembayaran</td>
                    <td>:</td>
                    <td style="border:1px solid #000">
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
                        {{$data['kegiatan'][0]->kegiatan_nama}}
                    </td>
                </tr>
                <tr>
                    <td>Terbilang</td>
                    <td>:</td>
                    <td class="trapezium">{{$data['kegiatan'][0]->kegiatanPembayaran[0]->terbilang}} Rupiah,-</td>
                </tr>
            </tbody>
        </table>

        <br>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:7cm">
                        Setuju Bayar,<br />
                        Pejabat Pembuat Komitmen
                    </td>
                    <td style="width:7cm">
                        Lunas Bayar,<br />
                        Bendahara Pengeluaran
                    </td>
                    <td style="width:7cm">
                        Kendari,
                        {{\Carbon\Carbon::parse($data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatan_pembayaran_tanggal)->format('d M Y')}},<br />
                        Yang Menerima
                    </td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>{{$data['ppk']->pengaturanJabatan->idpeg}}</b></td>
                    <td><b>{{$data['bendaharaPengeluaran']->pengaturanJabatan->idpeg}}</b></td>
                    <td><b>{{$data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatanPeserta->nama}}</b></td>
                </tr>
                <tr>
                    <td>NIP. 19692472645724</td>
                    <td>NIP. 19827648275474</td>
                    <td>NIP. {{$data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatanPeserta->nip}}</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>