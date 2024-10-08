<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <title>Report Data Kapal</title>
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

                    <td>{{ $p->KODE_KAPAL }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>