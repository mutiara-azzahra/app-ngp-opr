<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master Data Bendera</title>
    <style>
    h4,h2{
        font-family: 'Times New Roman', Times;
    }
        body{
            font-family:'Times New Roman', Times;
        }
        table{
        border-collapse: collapse;
        width:100%;
      }
      table, th, td{
        border: 1px solid black;
      }
      th{
        text-align: center;
      }
      .atas{
          text-align: left;
          border: none;
      }
      .atas-total{
          text-align: right;
          border: none;
      }
      .ttd-table{
          border: none;
          text-align: left;
      }
      .nama-kcp{
          text-align: left;
          border: none;
          font-size: 14px;
      }
      .alamat-kcp{
          text-align: left;
          border: none;
          font-size: 12px;
      }
      .nops{
          padding-top:10px;
          text-align: left;
          border: none;
      }
      .table-part{
          border: none;
      }
      td{
        text-align: center;
      }
      .td-part{
        text-align: left;
        border: none;
      }
      .td-qty{
        text-align: center;
        border: none;
      }
      .td-angka{
        text-align: right;
        border: none;
      }
      .th-header{
        text-align: center;
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
        border-left: none;
        border-right: none;
      }
      br{
          margin-bottom: 2px !important;
      }
      .table-bawah{
        border-left: none;
        border-right: none;
        line-height: 14px;
      }
     .judul{
         text-align: center;
     }
     .header{
         margin-bottom: 0;
         text-align: center;
         height: 105px;
         padding: 0px;
     }
     hr{
         height: 3px;
         background-color: black;
         width:100%;
     }
     .ttd{
        text-align: center;
        text-transform: uppercase;
     }
     .text-right{
         text-align:right;
     }
     .isi{
         padding:0px;
     }

    </style>
</head>
<body>
    <style>
        @page { 
          size: 21 cm 14.8 cm; 
          margin-top: 10px;
          margin-left: 5px;
          margin-right: 5px;
          padding: 0px !important;
          } 
    </style>
    <div class="header">
        <table class="table atas" style="line-height: 12px;">
            <tr>
                <td class="atas" style="width: 350px;">
                    <table class="atas" style="line-height: 13px;">
                        <tr>
                            <td class="atas">PT. NOGOPATMOLO</td>
                        </tr>
                        <tr>
                            <td class="atas">GENERAL WORKSHOP & DOCKYARD</td>
                        </tr>
                        <tr>
                            <td class="alamat-kcp">Jl. Ir. Pangeran Noor - Pasir Mas - Banjarmasin </td>
                        </tr>
                        <tr>
                            <td class="alamat-kcp">Telp. 0511 - 3352250 - 3364587, Fax. 0511 - 4367582</td>
                        </tr>
                    </table>
                </td>
                <td class="atas">
                    <table class="atas" style="line-height: 13px;">
                        <tr>
                            <td class="atas"><b>REPORTS</b></td>
                        </tr>
                        <tr>
                            <td class="atas"></td>
                        </tr>
                        <tr>
                            <td class="atas">Data</td>
                        </tr>
                        <tr>
                            <td class="atas">Data</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="line-height: 13px;">
                <td class="nops">
                    <table class="atas">
                        <tr>
                            <td class="atas">Nomor</td>
                            <td class="atas">:</td>
                            
                            <td class="atas"><b>Contoh/Nomor/Tahun</b></td>
                        </tr>
                    </table>
                </td>
                <td class="nops">
                    <table class="atas">
                        <tr>
                            <td class="atas">Tanggal Invoice</td>
                            <td class="atas">:</td>
                            <td class="atas">Contoh Tanggal</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="container">
        <div class="isi">
            <table class="table table-bawah">
                <thead>
                    <tr>
                        <th class="th-header">No.</th>
                        <th class="th-header">Nama Bendera</th>
                        <th class="th-header">Asal Negara</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i)
                    <tr>
                        <td class="td-qty">{{$loop->iteration}}.</td>
                        <td class="td-part">{{ $i->KODE_BENDERA }}</td>
                        <td class="td-part">{{ $i->ASAL_NEGARA }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="atas" style="line-height: 15px;">
                <tr>
                    
                </tr>
            </table>

            <br>
            <table class="atas">
                <tr>
                    <td class="atas">
                        <table class="table atas" style="line-height: 11px;">
                            <tr>
                                <td class="alamat-kcp">- Harga tsb belum termasuk PPN 11%</td>
                            </tr>
                            <tr>
                                <td class="alamat-kcp">- Plat/profil berkas milik galangan</td>
                            </tr>
                        </table>
                    </td>
                    <td class="nama-kcp" style="width: 250px">
                        <table class="atas">
                            <tr>
                                <td class="atas">
                                    <div class="ttd">
                                        <br>
                                        <h6 style="margin:0px; text-decoration:underline;" >Hormat kami</h6>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
            </table>
                
        </div>
    </div>
</body>
</html>