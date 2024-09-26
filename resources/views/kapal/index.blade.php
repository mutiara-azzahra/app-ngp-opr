@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Master Kapal</h1>
    <div class="ui divider"></div>
    <div class="column">
        <a class="ui positive button add"><i class="plus icon" style="visibility: visible;"></i> Tambah</a>
        <a class="ui negative button delete"><i class="trash icon" style="visibility: visible;" onchange="hapusCheckboxKapal()"></i> Hapus</a>
        <a class="ui orange button"><i class="print icon" style="visibility: visible;"></i> Cetak</a>
    </div>
    <div class="ui divider"></div>

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

    <table class="ui compact table celled" id="tableKapal">
        <thead>
            <tr>
                <th></th>
                <th class="center aligned">
                    <div class="ui checkbox">
                        <input class="ui checkbox semua" type="checkbox" tabindex="0">
                    </div>
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
                        <input type="checkbox" tabindex="0" value="{{ $i->FLAG_IDX }}" name="selected_items[]" onchange="pilihDataKapal(this.val)" name="_method">
                    </div>
                </td>
                <td class="kode">{{ $i->KODE_KAPAL }}</td>
                <td class="asal">{{ $i->NAMA_KAPAL }}</td>
                <td class="asal">{{ $i->CALLSIGN }}</td>
                <td class="asal">{{ $i->JENIS_KAPAL }}</td>
                <td class="asal">{{ $i->KODE_BENDERA }}</td>
                <td class="center aligned">
                    <button class="ui icon orange button show" id="{{ $i->FLAG_IDX }}" onclick="showDataKapal(this.id)"><i class="eye icon" style="visibility: visible;"></i></button>
                    <button class="ui icon primary button edit" id="{{ $i->FLAG_IDX }}" onclick="editDataKapal(this.id)"><i class="edit icon" style="visibility: visible;"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- MODAL UBAH DATA -->
    <div class="ui modal edit">
        <div class="header">Ubah Data Kapal</div>
        <div class="content">
            <form class="ui form" action="{{ route('kapal.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="content">
                    <div class="ui form">
                        <div class="two fields">
                            <div class="field">
                                <label>Kode Kapal
                                </label>
                                <input type="text" id="edit-kode-kapal" name="kode_kapal">
                            </div>
                            <div class="field">
                                <label>Nama Kapal
                                </label>
                                <input type="text" id="edit-nama-kapal" name="nama_kapal">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Callsign
                                </label>
                                <input type="text" id="edit-callsign" name="callsign">
                            </div>
                            <div class="field">
                                <label>Jenis Kapal
                                </label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="jenis_kapal">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Pilih Jenis Kapal</div>
                                    <div class="menu">
                                        @foreach($jenis_kapal as $i)
                                        <div class="item" name="jenis_kapal" id="jenis-kapal">{{ $i->JENIS_KAPAL}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Bendera
                                </label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="kode_bendera">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Pilih Bendera</div>
                                    <div class="menu">
                                        @foreach($bendera as $i)
                                        <div class="item" name="kode_bendera" id="bendera">{{ $i->KODE_BENDERA}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>Panjang
                                </label>
                                <input type="text" id="edit-panjang" name="panjang">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Lebar
                                </label>
                                <input type="text" id="edit-lebar" name="lebar">
                            </div>
                            <div class="field">
                                <label>Draft
                                </label>
                                <input type="text" id="edit-draft" name="draft">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Tinggi
                                </label>
                                <input type="text" id="edit-tinggi" name="tinggi">
                            </div>
                            <div class="field">
                                <label>Gross Ton
                                </label>
                                <input type="text" id="edit-gross-ton" name="gross_ton">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Dead Ton
                                </label>
                                <input type="text" id="edit-dead-ton" name="dead_ton">
                            </div>
                            <div class="field">
                                <label>Displacement
                                </label>
                                <input type="text" id="edit-displacement" name="displacement">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Jenis Mesin
                                </label>
                                <input type="text" id="edit-jenis-mesin" name="jenis_mesin">
                            </div>
                            <div class="field">
                                <label>Daya Mesin
                                </label>
                                <input type="text" id="edit-daya-mesin" name="daya_mesin">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Kecepatan Maks.
                                </label>
                                <input type="text" id="edit-kecepatan-max" name="kecepatan_maksimal">
                            </div>
                            <div class="field">
                                <label>Kapasitas Kargo / ton
                                </label>
                                <input type="text" id="edit-kapasitas-kargo" name="kapasitas_kargo">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Kapasitas Penumpang
                                </label>
                                <input type="text" id="edit-kapasitas-penumpang" name="kapasitas_penumpang">
                            </div>
                            <div class="field">
                                <label>Tahun Pembuatan
                                </label>
                                <input type="number" id="edit-tahun-pembuatan" name="tahun_pembuatan">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Galangan Kapal
                                </label>
                                <input type="text" id="edit-galangan-kapal" name="galangan_kapal">
                            </div>
                            <div class="field">
                                <label>Klasifikasi
                                </label>
                                <input type="text" id="edit-klasifikasi" name="klasifikasi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <button class="ui positive right labeled icon button" type="submit">
                        Simpan
                        <i class="checkmark icon"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- TAMBAH DATA KAPAL -->
        <div class="ui modal add">
            <div class="header">Tambah Data Kapal</div>
            <div class="content">
                <form class="ui form" action="{{ route('kapal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="two fields">
                        <div class="field">
                            <label>Kode Kapal
                            </label>
                            <input type="text" name="kode_kapal">
                        </div>
                        <div class="field">
                            <label>Nama Kapal
                            </label>
                            <input type="text" name="nama_kapal">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Callsign
                            </label>
                            <input type="text" name="callsign">
                        </div>
                        <div class="field">
                            <label>Jenis Kapal
                            </label>
                            <div class="field">
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="jenis_kapal">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Pilih Jenis Kapal</div>
                                    <div class="menu">
                                        @foreach($jenis_kapal as $i)
                                        <div class="item" name="jenis_kapal" value="{{ $i->JENIS_KAPAL }}">{{ $i->JENIS_KAPAL}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Bendera
                            </label>
                            <div class="field">
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="kode_bendera">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Pilih Bendera</div>
                                    <div class="menu">
                                        @foreach($bendera as $i)
                                        <div class="item" name="kode_bendera" value="{{ $i->KODE_BENDERA }}">{{ $i->KODE_BENDERA}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Panjang
                            </label>
                            <input type="text" class="regex" name="panjang">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Lebar
                            </label>
                            <input type="text" class="regex" name="lebar">
                        </div>
                        <div class="field">
                            <label>Draft
                            </label>
                            <input type="text" class="regex" name="draft">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Tinggi
                            </label>
                            <input type="text" class="regex" name="tinggi">
                        </div>
                        <div class="field">
                            <label>Gross Ton
                            </label>
                            <input type="text" class="regex" name="gross_ton">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Dead Ton
                            </label>
                            <input type="text" class="regex" name="dead_ton">
                        </div>
                        <div class="field">
                            <label>Displacement
                            </label>
                            <input type="text" class="regex" name="displacement">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Jenis Mesin
                            </label>
                            <input type="text" class="regex" name="jenis_mesin">
                        </div>
                        <div class="field">
                            <label>Daya Mesin
                            </label>
                            <input type="text" class="regex" name="daya_mesin">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Kecepatan Maks
                            </label>
                            <input type="text" class="regex" name="kecepatan_maksimal">
                        </div>
                        <div class="field">
                            <label>Kapasitas Kargo / ton
                            </label>
                            <input type="text" name="kapasitas_kargo">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Kapasitas Penumpang
                            </label>
                            <input type="text" class="regex" name="kapasitas_penumpang">
                        </div>
                        <div class="field">
                            <label>Tahun Pembuatan
                            </label>
                            <input type="number" name="tahun_pembuatan">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Galangan Kapal
                            </label>
                            <input type="text" name="galangan_kapal">
                        </div>
                        <div class="field">
                            <label>Klasifikasi
                            </label>
                            <input type="text" name="klasifikasi">
                        </div>
                    </div>
            </div>
            <div class="actions">
                <button class="ui negative deny button">
                    Batal
                </button>
                <button class="ui positive right labeled icon button" type="submit">
                    Simpan
                    <i class="checkmark icon"></i>
                </button>
            </div>
            </form>
        </div>

        <!-- MODAL SHOW DATA -->
        <div class="ui modal show" id="dataModal">
            <div class="header">Lihat Data Kapal</div>
            <div class="content">
                <div class="ui form">
                    <div class="two fields">
                        <div class="field">
                            <label>Kode Kapal
                            </label>
                            <input type="text" readonly id="kode-kapal" name="kode_kapal">
                        </div>
                        <div class="field">
                            <label>Nama Kapal
                            </label>
                            <input type="text" readonly id="nama-kapal" name="nama_kapal">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Callsign
                            </label>
                            <input type="text" readonly id="callsign" name="callsign">
                        </div>
                        <div class="field">
                            <label>Jenis Kapal
                            </label>
                            <input type="text" readonly id="jenis-kapal" name="jenis_kapal">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Bendera
                            </label>
                            <input type="text" readonly id="kode-bendera" name="kode_bendera">
                        </div>
                        <div class="field">
                            <label>Panjang
                            </label>
                            <input type="text" readonly id="panjang" name="panjang">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Lebar
                            </label>
                            <input type="text" readonly id="lebar" name="lebar">
                        </div>
                        <div class="field">
                            <label>Draft
                            </label>
                            <input type="text" readonly id="draft" name="draft">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Tinggi
                            </label>
                            <input type="text" readonly id="tinggi" name="tinggi">
                        </div>
                        <div class="field">
                            <label>Gross Ton
                            </label>
                            <input type="text" readonly id="gross-ton" name="gross_ton">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Dead Ton
                            </label>
                            <input type="text" readonly id="dead-ton" name="dead_ton">
                        </div>
                        <div class="field">
                            <label>Displacement
                            </label>
                            <input type="text" readonly id="displacement" name="displacement">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Jenis Mesin
                            </label>
                            <input type="text" readonly id="jenis-mesin" name="jenis_mesin">
                        </div>
                        <div class="field">
                            <label>Daya Mesin
                            </label>
                            <input type="text" readonly id="daya-mesin" name="daya_mesin">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Kecepatan Maks.
                            </label>
                            <input type="text" readonly id="kecepatan-max" name="kecepatan_maksimal">
                        </div>
                        <div class="field">
                            <label>Kapasitas Kargo / ton
                            </label>
                            <input type="text" readonly id="kapasitas-kargo" name="kapasitas_kargo">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Kapasitas Penumpang
                            </label>
                            <input type="text" readonly id="kapasitas-penumpang" name="kapasitas_penumpang">
                        </div>
                        <div class="field">
                            <label>Tahun Pembuatan
                            </label>
                            <input type="number" readonly id="tahun-pembuatan" name="tahun_pembuatan">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Galangan Kapal
                            </label>
                            <input type="text" readonly id="galangan-kapal" name="galangan_kapal">
                        </div>
                        <div class="field">
                            <label>Klasifikasi
                            </label>
                            <input type="text" readonly id="klasifikasi" name="klasifikasi">
                        </div>
                    </div>
                </div>
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

        @script
        <script>
            //SHOW DATA
            function showDataKapal(id) {

                $.ajax({
                    url: "{{ route('kapal.show') }}",
                    type: "GET",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $('#kode-kapal').val(response.KODE_KAPAL);
                        $('#nama-kapal').val(response.NAMA_KAPAL);
                        $('#callsign').val(response.CALLSIGN);
                        $('#jenis-kapal').val(response.JENIS_KAPAL);
                        $('#bendera').val(response.KODE_BENDERA);
                        $('#panjang').val(response.PANJANG);
                        $('#lebar').val(response.LEBAR);
                        $('#tinggi').val(response.TINGGI);
                        $('#draft').val(response.DRAFT);
                        $('#gross-ton').val(response.GROSS_TON);
                        $('#dead-ton').val(response.DEAD_TON);
                        $('#displacement').val(response.DISPLACEMENT);
                        $('#jenis-mesin').val(response.JENIS_MESIN);
                        $('#daya-mesin').val(response.DAYA_MESIN);
                        $('#kecepatan-max').val(response.KECEPATAN_MAX);
                        $('#kapasitas-kargo').val(response.KAPASITAS_KARGO);
                        $('#kapasitas-penumpang').val(response.KAPASITAS_PENUMPANG);
                        $('#tahun-pembuatan').val(response.TAHUN_PEMBUATAN);
                        $('#galangan-kapal').val(response.GALANGAN_KAPAL);
                        $('#klasifikasi').val(response.KLASIFIKASI);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                    }
                })
            }

            //EDIT DATA KAPAL
            function editDataKapal(id) {

                $.ajax({
                    url: "{{ route('kapal.edit') }}",
                    type: "GET",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $('#edit-kode-kapal').val(response.KODE_KAPAL);
                        $('#edit-nama-kapal').val(response.NAMA_KAPAL);
                        $('#edit-callsign').val(response.CALLSIGN);
                        $('#edit-jenis-kapal').val(response.JENIS_KAPAL);
                        $('#edit-kode-bendera').val(response.KODE_BENDERA);
                        $('#edit-panjang').val(response.PANJANG);
                        $('#edit-lebar').val(response.LEBAR);
                        $('#edit-tinggi').val(response.TINGGI);
                        $('#edit-draft').val(response.DRAFT);
                        $('#edit-gross-ton').val(response.GROSS_TON);
                        $('#edit-dead-ton').val(response.DEAD_TON);
                        $('#edit-displacement').val(response.DISPLACEMENT);
                        $('#edit-jenis-mesin').val(response.JENIS_MESIN);
                        $('#edit-daya-mesin').val(response.DAYA_MESIN);
                        $('#edit-kecepatan-max').val(response.KECEPATAN_MAX);
                        $('#edit-kapasitas-kargo').val(response.KAPASITAS_KARGO);
                        $('#edit-kapasitas-penumpang').val(response.KAPASITAS_PENUMPANG);
                        $('#edit-tahun-pembuatan').val(response.TAHUN_PEMBUATAN);
                        $('#edit-galangan-kapal').val(response.GALANGAN_KAPAL);
                        $('#edit-klasifikasi').val(response.KLASIFIKASI);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                    }
                })
            }

            //PILIH CHECKBOX
            function pilihDataKapal(id) {

                let datas_id = [];

                $('input[name="selected_items[]"]:checked').each(function(i) {
                    datas_id[i] = parseInt($(this).val());
                });

                console.log(datas_id)

                $('.ui.button.buttonHapus').click(function() {

                    datas_id.forEach(function(element) {
                        let el = document.getElementById(element);
                        if (el) {
                            el.remove();
                        }
                    });

                    $.ajax({
                        url: "{{ route('kapal.destroy') }}",
                        type: "GET",
                        data: {
                            hapus_data: datas_id,
                        },
                        success: function(response) {

                        },

                        error: function(xhr, status, error) {

                            console.error("Error fetching data: ", error);

                        }
                    });

                });

            }

            //UPDATE DATA KAPAL
            function updateDataKapal() {

                let kode_kapal = $('#edit-kode-kapal').val();
                let nama_kapal = $('#edit-nama-kapal').val();
                let callsign = $('#edit-callsign').val();
                let jenis_kapal = $('#edit-jenis-kapal').val();
                let kode_bendera = $('#edit-kode-bendera').val();
                let panjang = $('#edit-panjang').val();
                let lebar = $('#edit-lebar').val();
                let tinggi = $('#edit-tinggi').val();
                let draft = $('#edit-draft').val();
                let gross_ton = $('#edit-gross-ton').val();
                let dead_ton = $('#edit-dead-ton').val();
                let displacement = $('#edit-displacement').val();
                let jenis_mesin = $('#edit-jenis-mesin').val();
                let daya_mesin = $('#edit-daya-mesin').val();
                let kecepatan_max = $('#edit-kecepatan-max').val();
                let kapasitas_kargo = $('#edit-kapasitas-kargo').val();
                let kapasitas_penumpang = $('#edit-kapasitas=penumpang').val();
                let tahun_pembuatan = $('#edit-tahun-pembuatan').val();
                let galangan_kapal = $('#edit-galangan-kapal').val();
                let klasifikasi = $('#edit-klasifikasi').val();

                $.ajax({
                    url: "{{ route('kapal.update') }}",
                    type: "GET",
                    dataType: "json",
                    data: {
                        kode_kapal: kode_kapal,
                        nama_kapal: nama_kapal,
                        callsign: callsign,
                        jenis_kapal: jenis_kapal,
                        kode_bendera: kode_bendera,
                        panjang: panjang,
                        lebar: lebar,
                        tinggi: tinggi,
                        draft: draft,
                        gross_ton: gross_ton,
                        dead_ton: dead_ton,
                        displacement: displacement,
                        jenis_mesin: jenis_mesin,
                        daya_mesin: daya_mesin,
                        kecepatan_max: kecepatan_max,
                        kapasitas_kargo: kapasitas_kargo,
                        kapasitas_penumpang: kapasitas_penumpang,
                        tahun_pembuatan: tahun_pembuatan,
                        galangan_kapal: galangan_kapal,
                        klasifikasi: klasifikasi

                    },
                    success: function(response) {
                        console.alert(reponse)
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                    }
                })
            }
        </script>

        @endscript