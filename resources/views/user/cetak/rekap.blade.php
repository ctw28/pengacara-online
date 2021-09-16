<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK REKAP</title>
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
        <h1 class="text-center"><u>REKAP</u></h1>


        <br />
        <!--TITLE END-->

        <table border="1" cellpadding="2" cellspacing="0">
            <thead>
                <tr>
                    <th style="width:1cm">No.</th>
                    <th style="width:19.7cm">Uraian</th>
                    <th style="width:3cm">Jumlah</th>
                    <th style="width:3cm">PPh Pasal 21</th>
                    <th style="width:3cm">Jumlah Rupiah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
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
                        {{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->total_terima, 0, ',','.')}}
                    </td>
                </tr>
            </tbody>
            <tfooter>
                <tr>
                    <th colspan="2">Jumlah</th>
                    <th>{{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->total_keseluruhan, 0, ',','.')}}
                    </th>
                    <th>{{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->pajak, 0, ',','.')}}</th>
                    <th> {{number_format($data['kegiatan'][0]->kegiatanPembayaran[0]->total_terima, 0, ',','.')}}

                    </th>
                </tr>
            </tfooter>
        </table>
        <br>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:9.5cm">
                        Mengetahui,<br>
                        Pejabat Pembuat Komitmen
                    </td>
                    <td style="width:9.5cm">
                    </td>
                    <td style="width:10.7cm">
                        Kendari,
                        {{\Carbon\Carbon::parse($data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatan_pembayaran_tanggal)->format('d M Y')}},<br />
                        Bendahara Pengeluaran
                    </td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Dr.s Musdin</b></td>
                    <td></td>
                    <td><b>Nisful Hijah, SE</b></td>
                </tr>
                <tr>
                    <td>NIP. 19692472645724</td>
                    <td></td>
                    <td>NIP. 19692472645724</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>