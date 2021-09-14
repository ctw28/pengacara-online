<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Cetak Lembar Permohonan Pemeriksaan Berkas Pencairan Anggaran</title>
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

        .p0 {
            margin-block-start: 0;
            margin-block-end: 0;
        }
    }
    </style>
</head>
<!--
<body onload="window.print()" onfocus="window.close()">
-->

<body style="color:#000;font-size:15px;">

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
        <h3 class="text-center">LEMBAR PERMOHONAN PEMERIKSAAN BERKAS<br />PENCAIRAN ANGGARAN</h3>
        <br />
        <!--TITLE END-->


        <p>Kepada Yth :<br>
            Ketua SPI<br>
            IAIN Kendari<br>
            Di -<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kendari</p><br>


        <p style="text-align:justify">Assalamu Alaikum Warahmatullahi Wabarakatuh<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Dengan ini kami mengajukan permintaan pembayaran
            <b><i>@foreach($data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatanPembayaranSesi as $index=> $row)
                    {{$row->kegiatanBayarJabatan->mBayarKategori->bayar_nama}}
                    {{$row->kegiatanBayarJabatan->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama}}
                    @if(count($data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatanPembayaranSesi) -2 > $index)
                    {{","}}
                    @endif
                    @if(count($data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatanPembayaranSesi) -2 == $index)
                    dan
                    @endif
                    @endforeach
                    {{$data['kegiatan'][0]->kegiatan_nama}}</i></b>
            Sesuai SK {{$data['kegiatan'][0]->kegiatan_sk}} Tanggal {{$data['kegiatan'][0]->kegiatan_sk_tanggal}}
            sebesar
            <b><i>Rp. {{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->total_keseluruhan, 0, ',','.')}}, –
                    ({{$data['kegiatan'][0]->kegiatanPembayaran[0]->terbilang}} Rupiah).</i></b><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Demikian, permohonan ini atas kerjasamanya diucapkan terima kasih.
        </p>



        <br>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:7cm">
                    </td>
                    <td style="width:7cm">
                    </td>
                    <td style="width:7cm">
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
                    <td><b></b></td>
                    <td><b></b></td>
                    <td><b>Drs. Musdin, M.Pd.I</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>NIP. 19827648275474</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>