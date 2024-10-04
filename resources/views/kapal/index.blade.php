@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Master Kapal</h1>
    <div class="ui divider hidden"></div>
    <div class="column">
        <a class="ui positive button add"><i class="plus icon" style="visibility: visible;"></i> Tambah</a>
        <a class="ui negative button delete"><i class="trash icon" style="visibility: visible;" onchange="hapusCheckboxKapal()"></i> Hapus</a>
        <a class="ui orange button"><i class="print icon" style="visibility: visible;"></i> Cetak</a>
    </div>
    <div class="ui divider hidden"></div>

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

    <table class="ui compact table celled" id="example">
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
                <th class="center aligned">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kapal as $i)
            <tr id="{{ $i->FLAG_IDX }}">
                <td>{{ $no++ }}</td>
                <td class="center aligned">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" value="{{ $i->FLAG_IDX }}" name="selected_items[]" onchange="pilihDataKapal(this.val)">
                    </div>
                </td>
                <td class="kode">{{ $i->KODE_KAPAL }}</td>
                <td class="asal">{{ $i->NAMA_KAPAL }}</td>
                <td class="asal">{{ $i->CALLSIGN }}</td>
                <td class="asal">{{ $i->JENIS_KAPAL }}</td>
                <td class="asal">{{ $i->KODE_BENDERA }}/{{ $i->bendera->ASAL_NEGARA }}</td>
                <td class="center aligned">
                    <button class="ui icon orange button show" id="{{ $i->FLAG_IDX }}" onclick="showDataKapal(this.id)"><i class="eye icon" style="visibility: visible;"></i></button>
                    <a class="ui icon primary button" href="{{ route('kapal.edit', $i->FLAG_IDX) }}"><i class="edit icon" style="visibility: visible;"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TAMBAH DATA KAPAL -->
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
                        <input type="text" class="data-input" name="panjang" placeholder="Isi panjang kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Lebar <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="lebar" placeholder="Isi lebar kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Draft <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="draft" placeholder="Isi callsign kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Tinggi <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="tinggi" placeholder="Isi tinggi kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Gross Ton <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="gross_ton" placeholder="Isi gross kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Dead Ton <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="dead_ton" placeholder="Isi dead ton kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Displacement <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="displacement" placeholder="Isi displacement kapal">
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
                        <input type="text" class="data-input" name="daya_mesin" placeholder="Isi daya mesin kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Kecepatan Maks.</label>
                            <span class="ui red text input-desimal" id="input-desimal" style="display: none;">*angka, gunakan desimal '.'</span>
                        </div>
                        <input type="text" class="data-input" name="kecepatan_maksimal" placeholder="Isi kecepatan maksimal kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Kapasitas Kargo / ton <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="kapasitas_kargo" placeholder="Isi kapasitas kargo kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Kapasitas Penumpang / orang</label>
                        <input type="number" name="kapasitas_penumpang" placeholder="Isi kapasitas penumpang">
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
        <div class="header">Lihat Data Kapal</div>
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
            <button class="ui negative icon button buttonHapus" type="submit">
                <i class="trash icon"></i>
                Hapus
            </button>
        </div>
    </div>
    @endsection