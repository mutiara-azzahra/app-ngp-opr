@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Master Kapal</h1>
    <div class="ui divider hidden"></div>
    <div class="column">
        <a class="ui positive button add"><i class="plus icon" style="visibility: visible;"></i> Tambah</a>
        <a class="ui negative button delete"><i class="trash icon" style="visibility: visible;"></i> Hapus</a>
        <a class="ui orange button print"><i class="print icon" style="visibility: visible;"></i> Cetak</a>
    </div>
    <div class="ui divider hidden"></div>
    <div id="alert_response"></div>
    @if ($errors->any())
    <div class="ui negative message">
        <i class="close icon"></i>
        <div class="header">
            Data gagal disimpan
        </div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if ($message = Session::get('success'))
    <div class="ui poitive message">
        <i class="close icon"></i>
        <div class="header">
            Data tesimpan
        </div>
        <p>{{ $message }}</p>
    </div>
    @elseif ($message = Session::get('danger'))
    <div class="ui negative message">
        <i class="close icon"></i>
        <div class="header">
            Data gagal disimpan
        </div>
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="ui compact table celled" id="table_paging">
        <thead>
            <tr>
                <th></th>
                <th class="center aligned">
                </th>
                <th class="center aligned">Kode Kapal</th>
                <th class="center aligned">Nama Kapal</th>
                <th class="center aligned">Callsign</th>
                <th class="center aligned">Jenis Kapal</th>
                <th class="center aligned">Bendera</th>
                <th class="center aligned">Panjang/Lebar/Tinggi</th>
                <th class="center aligned">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kapal as $i)
            <tr>
                <td class="center aligned">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" value="{{ $i->FLAG_IDX }}" name="checkboxes">
                    </div>
                </td>
                <td class="center aligned">{{ $no++ }}</td>
                <td class="kode">{{ $i->KODE_KAPAL }}</td>
                <td class="asal">{{ $i->NAMA_KAPAL }}</td>
                <td class="asal">{{ $i->CALLSIGN }}</td>
                <td class="asal">{{ $i->JENIS_KAPAL }}</td>
                <td class="asal">{{ $i->KODE_BENDERA }}/{{ $i->bendera->ASAL_NEGARA }}</td>
                <td class="asal">{{ number_format($i->PANJANG, 2, '.', ',') }} m² / {{ number_format($i->LEBAR, 2, '.', ',') }} m² / {{ number_format($i->TINGGI, 2, '.', ',') }} m²</td>
                <td class="center aligned">
                    <button class="ui icon orange button show" id="{{ $i->FLAG_IDX }}" onclick="showDataKapal(this.id)"><i class="eye icon" style="visibility: visible;"></i></button>
                    <a class="ui icon primary button" href="{{ route('kapal.edit', $i->FLAG_IDX) }}"><i class="edit icon" style="visibility: visible;"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- MODAL TAMBAH DATA -->
    <div class="ui modal add">
        <div class="header">Tambah Data Kapal</div>
        <div class="content">
            <form class="ui form" action="{{ route('kapal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label>Kode Kapal</label>
                        <input type="text" name="kode_kapal" placeholder="Isi kode kapal">
                    </div>
                    <div class="field">
                        <label>Nama Kapal
                        </label>
                        <input type="text" name="nama_kapal" placeholder="Isi nama kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Callsign</label>
                        <input type="text" name="callsign" placeholder="Isi callsign kapal">
                    </div>
                    <div class="field">
                        <label>Jenis Kapal</label>
                        <div class="field">
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="jenis_kapal">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih Jenis Kapal</div>
                                <div class="menu">
                                    @foreach($jenis_kapal as $i)
                                    <div class="item" name="jenis_kapal" data-value="{{ $i->JENIS_KAPAL }}">{{ $i->JENIS_KAPAL }} / {{ $i->G1 }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Bendera</label>
                        <div class="field">
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="kode_bendera">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih Bendera Kapal</div>
                                <div class="menu">
                                    @foreach($bendera as $i)
                                    <div class="item" name="kode_bendera" data-value="{{ $i->KODE_BENDERA }}">{{ $i->KODE_BENDERA}} / {{ $i->ASAL_NEGARA }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Panjang <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="number" class="data-input" step=".01" name="panjang" placeholder="Isi panjang kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Lebar <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="number" class="data-input" step=".01" name="lebar" placeholder="Isi lebar kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Draft <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="number" class="data-input" step=".01" name="draft" placeholder="Isi callsign kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Tinggi <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="number" class="data-input" step=".01" name="tinggi" placeholder="Isi tinggi kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Gross Ton <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="number" class="data-input" step=".01" name="gross_ton" placeholder="Isi gross kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Dead Ton <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="number" class="data-input" step=".01" name="dead_ton" placeholder="Isi dead ton kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Displacement <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="number" class="data-input" step=".01" name="displacement" placeholder="Isi displacement kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Jenis Mesin</label>
                        </div>
                        <input type="text" name="jenis_mesin" placeholder="Isi jenis mesin kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Daya Mesin <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="number" class="data-input" step=".01" name="daya_mesin" placeholder="Isi daya mesin kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Kecepatan Maks.</label>
                            <span class="ui red text input-desimal" id="input-desimal" style="display: none;">*angka, gunakan desimal '.'</span>
                        </div>
                        <input type="number" class="data-input" step=".01" name="kecepatan_maksimal" placeholder="Isi kecepatan maksimal kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Kapasitas Kargo / ton <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="number" class="data-input" step=".01" name="kapasitas_kargo" placeholder="Isi kapasitas kargo kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Kapasitas Penumpang / orang <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        <input type="number" class="data-input" step=".01" name="kapasitas_penumpang" placeholder="Isi kapasitas penumpang">
                    </div>
                    <div class="field">
                        <label>Tahun Pembuatan Kapal</label>
                        <div class="ui calendar" id="year_calendar">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" name="tahun_pembuatan" placeholder="Pilih tahun">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Galangan Kapal</label>
                        <input type="text" name="galangan_kapal" placeholder="Isi galangan kapal">
                    </div>
                    <div class="field">
                        <label>Klasifikasi</label>
                        <input type="text" name="klasifikasi" placeholder="Isi klasifikasi kapal">
                    </div>
                </div>
        </div>
        <div class="actions">
            <a class="ui negative deny button">
                Batal
            </a>
            <button class="ui positive right labeled icon button" type="submit">
                <i class="checkmark icon"></i>
                Simpan
            </button>
        </div>
        </form>
    </div>
    <!-- MODAL SHOW DATA -->
    <div class="ui modal show">
        <div class="header">
            <div class="ui grid">
                <div class="column row">
                    <div class="left floated column">Lihat Data Kapal</div>
                    <div class="right floated column">
                        <a class="ui orange button" onsubmit="" href="" target="_blank">
                            <i class="print icon"></i>Cetak
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="ui form" id="result-show"></div>
        </div>
    </div>
    <!-- MODAL HAPUS DATA -->
    <div class="ui modal delete">
        <div class="header">
            Hapus data ini?
        </div>
        <div class="content">
            <p>Data ini tidak dapat kembali</p>
        </div>
        <div class="actions">
            <form class="ui form" action="{{ route('kapal.destroy') }}" method="POST" enctype="multipart/form-data" onsubmit="checkedDataDelete()">
                @csrf
                @method('DELETE')
                <input type="hidden" id="selectedCheckboxesDelete" name="selectedCheckboxesDelete">
                <button class="ui negative button" type="submit">
                    <i class="trash icon"></i>
                    Hapus
                </button>
            </form>
        </div>
    </div>
    <!-- MODAL CETAK DATA -->
    <div class="ui modal print">
        <div class="header">
            Pilih Cetak Data
        </div>
        <div class="content">
            <div class="ui grid">
                <div class="one column row">
                    <form class="ui form" action="{{ route('kapal.print') }}" method="GET" enctype="multipart/form-data" onsubmit="checkedData()" target="_blank">
                        @csrf
                        @method('GET')
                        <input type="hidden" id="selectedCheckboxesPrint" name="selectedCheckboxesPrint">
                        <button class="ui positive button">
                            <i class="print icon"></i>
                            Cetak PDF
                        </button>
                    </form>

                    <form class="ui form" action="{{ route('kapal.print_excel') }}" method="GET" enctype="multipart/form-data" onsubmit="checkedDataExcel()" target="_blank">
                        @csrf
                        @method('GET')
                        <input type="hidden" id="selectedPrintExcel" name="selectedPrintExcel">
                        <button class="ui orange button">
                            <i class="print icon"></i>
                            Cetak Excel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let data_id = []

    $('input[name="checkboxes"]').change(function() {
        let checked = parseInt($(this).val())

        if ($(this).is(':checked')) {
            data_id.push(checked)
        } else {
            data_id.splice($.inArray(checked, data_id), 1)
        }
    });

    function checkedData() {
        document.getElementById('selectedCheckboxesPrint').value = data_id
    }

    function checkedDataDelete() {
        document.getElementById('selectedCheckboxesDelete').value = data_id
    }

    function checkedDataExcel() {
        document.getElementById('selectedPrintExcel').value = data_id
    }
</script>
@endsection