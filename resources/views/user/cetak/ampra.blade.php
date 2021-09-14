<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK AMPRA</title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
    @page {
        size: 21cm 29.7cm portrait;
        /* A4 size */
        margin: 1cm 2cm 1cm 2cm;
        /* this affects the margin in the printer settings */
    }

    @media all {

        body,
        table {
            background-color: #FFFFFF;
            color: #000;
            font-size: 14px;
        }

        .page-break {
            display: none;
            display: block;
            page-break-after: always;
        }

        .border {
            border-top: none;
            border-bottom: none;
        }

        .text-center {
            text-align: center;
            margin: 0 auto;
        }

        .text-right {
            text-align: right;
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

    <div style="width:21cm;margin:0 auto;">

        <!--TITLE-->
        <h4 class="text-center" style="text-transform:uppercase">
            PEMBAYARAN {{$data['dataPembayaran'][0]->mbayarKategori->bayar_nama}}
            {{$data['dataPembayaran'][0]->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama}}
            {{$data['kegiatan']->kegiatan_nama}}
        </h4>
        <br />
        <!--TITLE END-->

        <!--CONTENT-->
        <table border="1" cellpadding="3" cellspacing="0">
            <thead>
                <tr style="font-size:12px;">
                    <th style="width:0.5cm">NO.</th>
                    <th style="width:4cm">NAMA</th>
                    <th style="width:1cm">GOL.</th>
                    <th style="width:1.5cm">JABATAN</th>
                    <th style="width:6.5cm">JUMLAH HONOR (Rp)</th>
                    @if($data['pajak']==true)
                    <th style="width:2.5cm">PAJAK (Rp)</th>
                    @endif
                    <th style="width:2.5cm">JUMLAH YANG <br>DITERIMA(Rp)</th>
                    <th style="width:2.5cm">NOMOR <br> REKENING</th>
                </tr>
                <tr style="font-size:10px;" class="text-center">
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    @if($data['pajak']==true)
                    <td>7</td>
                    <td>8</td>
                    @else
                    <td>7</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($data['dataPembayaran'][0]->kegiatanPembayaranSesi->kegiatanPesertaBayar as $index => $row)
                <tr>
                    <td class="border text-center">{{$index+1}}</td>
                    <td class="border">{{$row->kegiatanPeserta->nama}}</td>
                    <td class="border text-center">{{$row->kegiatanPeserta->golongan}}</td>
                    <td class="border text-center">
                        {{$data['dataPembayaran'][0]->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama}}
                    </td>
                    <td class="border text-center">{{number_format($row->honor, 0, ',','.')}} x {{$row->jumlah}}
                        {{$row->masterSatuan->master_satuan_nama}} = {{number_format($row->total, 0, ',','.')}}</td>
                    @if($data['pajak']==true)
                    <td class="border text-center">{{number_format($row->pajak,0, ',','.')}}</td>
                    <input type="hidden" value="{{$row->pajak}}" name="data[{{$index}}][pajak]">
                    @endif
                    <td class="border text-center">{{number_format($row->terima, 0, ',','.')}}</td>
                    <td class="border text-center">Terlampir</td>
                </tr>
                @endforeach
            </tbody>
            <tfooter>
                <tr style="font-size:13px;">
                    <th colspan="4" class="text-center">JUMLAH</th>
                    <th class="text-center">{{number_format($data['total'], 0, ',','.')}}</th>
                    @if($data['pajak']==true)
                    <th class="text-center">{{number_format($data['totalPajak'], 0, ',','.')}}</th>
                    @endif
                    <th class="text-right">{{number_format($data['totalTerima'], 0, ',','.')}}</th>
                    <th></th>
                </tr>
            </tfooter>
        </table>

        <br>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:1cm">&nbsp;</td>
                    <td style="width:7cm;vertical-align:bottom;">
                        Setuju Bayar,<br />
                        Pejabat Pembuat Komitmen
                    </td>
                    <td style="width:5cm">&nbsp;</td>
                    <td style="width:7cm">
                        Kendari,
                        {{\Carbon\Carbon::parse($data['pembayaran']->kegiatan_pembayaran_tanggal)->format('d M Y')}},<br />
                        Lunas Bayar<br>
                        Tgl.
                        {{\Carbon\Carbon::parse($data['pembayaran']->kegiatan_pembayaran_tanggal_lunas)->format('d M Y')}}<br>
                        Bendahara Pengeluaran
                    </td>
                    <td style="width:1cm">&nbsp;</td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <b>Dr.s Musdin</b><br>
                        NIP. 19692472645724
                    </td>
                    <td></td>
                    <td>
                        <b>Nisful HIjah, SE</b><br>
                        NIP. 19827648275474
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>