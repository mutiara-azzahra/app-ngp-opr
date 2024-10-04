<!DOCTYPE html>
<html lang="en">

<head>
    <title>Report Data Kapal</title>
    <style>
        h4,
        h2 {
            font-family: 'Times New Roman', Times;
        }

        body {
            font-family: 'Times New Roman', Times;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            text-align: center;
        }

        .atas {
            text-align: left;
            border: none;
        }

        .atas-isi {
            text-align: left;
            width: 150px;
            border: none;
        }

        .atas-header {
            text-align: center;
            border: none;
        }

        .atas-total {
            text-align: right;
            border: none;
        }

        .ttd-table {
            border: none;
            text-align: left;
        }

        .nama-kcp {
            text-align: left;
            border: none;
            font-size: 14px;
        }

        .alamat-kcp {
            text-align: left;
            border: none;
            font-size: 12px;
        }

        .nops {
            padding-top: 10px;
            text-align: left;
            border: none;
        }

        .table-part {
            border: none;
        }

        td {
            text-align: center;
        }

        .td-part {
            text-align: right;
            border-top: 0.5px solid #000;
            border-bottom: 0.5px solid #000;
            border-left: none;
            border-right: none;
        }

        .td-qty {
            text-align: left;
            border: 0.5px solid #000;
        }

        .td-angka {
            text-align: center;
            border-top: 0.5px solid #000;
            border-bottom: 0.5px solid #000;
            border-left: none;
            border-right: none;
        }

        .th-header {
            text-align: center;
            border-top: 0.5px solid #000;
            border-bottom: 0.5px solid #000;
            border-left: none;
            border-right: none;
        }

        br {
            margin-bottom: 2px !important;
        }

        .table-bawah {
            border-left: none;
            border-right: none;
            line-height: 14px;
        }

        .judul {
            text-align: center;
        }

        .header {
            margin-bottom: 0;
            text-align: center;
            height: 40px;
            padding: 0px;
        }

        .isi {
            margin-bottom: 0;
            text-align: center;
            height: 10px;
        }

        .judul {
            margin-bottom: 0;
            text-align: center;
            height: 60px;
        }

        hr {
            height: 3px;
            background-color: black;
            width: 100%;
        }

        .text-right {
            text-align: right;
        }

        .ttd {
            text-align: center;
            text-transform: uppercase;
        }

        .ttd-biasa {
            text-align: center;
        }
    </style>
</head>

<body>
    <style>
        @page {
            size: 21 cm 29.6 cm;
            margin: 10px;
            padding: 0px !important;
        }
    </style>
    <div class="header">
        <table class="table atas" style="line-height: 15px;">
            <tr>
                <td class="atas">PT. Nogopatmolo</td>
            </tr>
        </table>
    </div>
    <div class="judul">
        <table class="atas" style="line-height: 15px;">
            <tr>
                <td class="atas-header">
                    <h4 style="text-decoration:underline; text-transform: uppercase; margin:0px">Data Reports Kapal</h4>
                </td>
            </tr>
        </table>
        <table class="atas">
            <tr>
                <td class="atas">Periode</td>
                <td class="atas">:</td>
                <td class="atas"></td>
            </tr>
            <tr>
                <td class="atas">Cetak Oleh</td>
                <td class="atas">:</td>
                <td class="atas">{{ Auth::user()->USERNAME }}, {{ NOW() }}</td>
            </tr>
        </table>
    </div>

    <div class="isi">
        <table class="table table-bawah" style="line-height: 16px;">
            <thead>
                <tr>
                    <th class="th-header">Kode Kapal</th>
                    <th class="th-header">Nama Kapal</th>
                    <th class="th-header">Callsign</th>
                    <th class="th-header">Jenis Kapal</th>
                    <th class="th-header">Asal Negara</th>
                    <th class="th-header">Panjang</th>
                    <th class="th-header">Lebar</th>
                    <th class="th-header">Tinggi</th>
                    <th class="th-header">Jenis Mesin</th>
                    <th class="th-header">Daya Mesin</th>
                    <th class="th-header">Galangan Kapal</th>
                    <th class="th-header">Klasifikasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $p)
                <tr>
                    <td class="td-qty">{{ $data->KODE_KAPAL }}</td>
                    <td class="td-qty">{{ $data->NAMA_KAPAL }}</td>
                    <td class="td-qty">{{$p->CALLSIGN }}</td>
                    <td class="td-qty">{{$p->JENIS_KAPAL }}</td>
                    <td class="td-qty">{{$p->ASAL_NEGARA }}</td>
                    <td class="td-qty">{{$p->PANJANG }}</td>
                    <td class="td-qty">{{$p->LEBAR }}</td>
                    <td class="td-qty">{{$p->TINGGI }}</td>
                    <td class="td-qty">{{$p->JENIS_MESIN }}</td>
                    <td class="td-qty">{{$p->DAYA_MESIN }}</td>
                    <td class="td-qty">{{$p->GALANGAN_KAPAL }}</td>
                    <td class="td-qty">{{$p->KLASIFIKASI }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="td-angka"><b>TOTAL</b></td>
                    <td class="td-part">{{ number_format($getReport->sum('nominal'), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>