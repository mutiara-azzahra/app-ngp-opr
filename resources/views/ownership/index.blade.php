@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Master Ownership</h1>
    <div class="ui divider"></div>
    <div class="column">
        <a class="ui positive button add"><i class="plus icon" style="visibility: visible;"></i> Tambah</a>
        <a class="ui negative button delete"><i class="trash icon" style="visibility: visible;"></i> Hapus</a>
        <a class="ui orange button"><i class="print icon" style="visibility: visible;"></i> Cetak</a>
    </div>
    <div class="ui divider"></div>

    @if ($message = Session::get('success'))
    <div class="ui positive message">
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

    <table class="ui compact table celled" id="tableBendera">
        <thead>
            <tr>
                <th></th>
                <th class="center aligned">
                    <div class="ui checkbox">
                        <input class="ui checkbox semua" type="checkbox" tabindex="0">
                    </div>
                </th>
                <th class="center aligned">Kode Ownership</th>
                <th class="center aligned">Class</th>
                <th class="center aligned">Nama Pemilik</th>
                <th class="center aligned">Operator Kapal</th>
                <th class="center aligned">Operator Pihak Ketiga</th>
                <th class="center aligned">Email</th>
                <th class="center aligned">Nomor Telpon</th>
                <th class="center aligned">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ownership as $i)
            <tr id="{{ $i->FLAG_IDX }}">
                <td>{{ $no++ }}</td>
                <td class="center aligned">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" value="{{ $i->FLAG_IDX }}" name="selected_items[]" onchange="hapusCheckboxOwnership()">
                    </div>
                </td>
                <td class="kode">{{ $i->KODE_OS }}</td>
                <td class="asal">{{ $i->CLASS }}</td>
                <td class="asal">{{ $i->NAMA_PEMILIK_TERDAFTAR }}</td>
                <td class="asal">{{ $i->OPERATOR_KAPAL }}</td>
                <td class="asal">{{ $i->OPERATOR_PIHAK_KETIGA }}</td>
                <td class="asal">{{ $i->EMAIL }}</td>
                <td class="asal">{{ $i->TELPON }}</td>
                <td class="center aligned">
                    <button class="ui icon orange button" id="{{ $i->FLAG_IDX }}" onclick="showDataKapal(this.id)"><i class="eye icon" style="visibility: visible;"></i></button>
                    <button class="ui icon primary button" id="{{ $i->FLAG_IDX }}" onclick="editDataKapal(this.id)"><i class="edit icon" style="visibility: visible;"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- MODAL UBAH DATA -->
    <div class="ui modal edit">
        <div class="header">Ubah Data Ownership</div>
        <div class="content">
            <form class="ui form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label>Kode Ownership
                        </label>
                        <input type="text" id="edit-kode-ownership" name="kode_kapal" readonly>
                    </div>
                    <div class="field">
                        <label>Nama Ownership
                        </label>
                        <input type="text" id="edit-nama-ownership" name="nama_kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Callsign
                        </label>
                        <input type="text" id="edit-callsign" name="callsign" readonly>
                    </div>
                    <div class="field">
                        <label>Jenis Ownership
                        </label>
                        <input type="text" id="edit-jenis-ownership" name="jenis_kapal">
                        <div class="ui fluid search selection dropdown">
                            <input type="hidden" name="country">
                            <i class="dropdown icon"></i>
                            <div class="default text">Select Country</div>
                            <div class="menu">
                                <div class="item" data-value="af"><i class="af flag"></i>Afghanistan</div>
                                <div class="item" data-value="ax"><i class="ax flag"></i>Aland Islands</div>
                                <div class="item" data-value="al"><i class="al flag"></i>Albania</div>
                                <div class="item" data-value="dz"><i class="dz flag"></i>Algeria</div>
                            </div>
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Kode Bendera
                            </label>
                            <input type="text" id="edit-kode-bendera" name="kode_bendera" readonly>
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
                            <input type="text" id="edit-lebar" name="lebar" readonly>
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
                            <input type="text" id="edit-tinggi" name="tinggi" readonly>
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
                            <input type="text" id="edit-dead-ton" name="dead_ton" readonly>
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
                            <input type="text" id="edit-jenis-mesin" name="jenis_mesin" readonly>
                        </div>
                        <div class="field">
                            <label>Daya Mesin
                            </label>
                            <input type="text" id="edit-daya-mesin" name="daya_mesin">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Kecepatan Maksimal
                            </label>
                            <input type="text" id="edit-kecepatan-maksimal" name="kecepatan_maksimal" readonly>
                        </div>
                        <div class="field">
                            <label>Kapasitas Kargo
                            </label>
                            <input type="text" id="edit-kapasitas-kargo" name="kapasitas_kargo">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Kapasitas Penumpang
                            </label>
                            <input type="text" id="edit-kapasitas-penumpang" name="kapasitas_penumpang" readonly>
                        </div>
                        <div class="field">
                            <label>Tahun Pembuatan
                            </label>
                            <input type="text" id="edit-tahun-pembuatan" name="tahun_pembuatan">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Galangan Ownership
                            </label>
                            <input type="text" id="edit-galangan-ownership" name="galangan_kapal" readonly>
                        </div>
                        <div class="field">
                            <label>Klasifikasi
                            </label>
                            <input type="text" id="edit-klasifikasi" name="klasifikasi" readonly>
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

        <div class="ui modal add">
            <div class="header">Tambah Data Ownership</div>
            <div class="content">
                <form class="ui form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="two fields">
                        <div class="field">
                            <label>Kode Ownership
                            </label>
                            <input type="text" name="kode_kapal">
                        </div>
                        <div class="field">
                            <label>Nama Ownership
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
                            <label>Jenis Ownership
                            </label>
                            <div class="field">
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="jenis_kapal">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Pilih Jenis Ownership</div>
                                    <div class="menu">
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
                            <label>Galangan Ownership
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
            <div class="header">Detail Data Ownership</div>
            <div class="content">
                <div class="ui form">
                    <div class="field">
                        <label>Kode Ownership</label>
                        <input type="text" id="kode-bendera" readonly>
                    </div>
                    <div class="field">
                        <label>Asal Negara</label>
                        <input type="text" id="asal-negara" readonly>
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
                <button class="ui primary deny button">
                    Batal
                </button>
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

                let get = document.getElementById(id);
                let kodeBendera = get.getElementsByTagName("td")[2].innerHTML;
                let asalNegara = get.getElementsByTagName("td")[3].innerHTML;

                $.ajax({
                    url: "{{ route('bendera.index') }}",
                    type: "GET",
                    data: {
                        asalNegara: asalNegara,
                        kodeBendera: kodeBendera,
                    },
                    success: function(data) {
                        $('#kode-bendera').val(kodeBendera);
                        $('#asal-negara').val(asalNegara);
                    },
                })
            }

            //HAPUS DATA CHECKBOXES
            function hapusCheckboxOwnership() {

                let id = []

                $('input[name="selected_items[]"]:checked').each(function(i) {
                    id[i] = $(this).val();

                });

                $('.ui.button.buttonHapus').click(function() {

                    id.forEach(function(element) {
                        let el = document.getElementById(element);

                        console.log(el)
                        if (el) {
                            el.remove();
                        }
                    });

                    $.ajax({
                        url: "{{ route('bendera.destroy') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id

                        },
                        success: function(data) {

                        },

                        error: function(xhr, status, error) {

                        }
                    });

                });
            }

            function editDataKapal(id) {
                let get = document.getElementById(id);
                let kodeBendera = get.getElementsByTagName("td")[2].innerHTML;
                let asalNegara = get.getElementsByTagName("td")[3].innerHTML;

                $.ajax({
                    url: "{{ route('bendera.index') }}",
                    type: "GET",
                    data: {
                        asalNegara: asalNegara,
                        kodeBendera: kodeBendera,
                    },
                    success: function(data) {
                        $('#edit-kode-bendera').val(kodeBendera);
                        $('#edit-asal-negara').val(asalNegara);
                    },
                })


                $('.ui.button.buttonEdit').click(function() {

                    console.log('tes')

                    let id = $('#edit-id').val();
                    let kodeBendera = $('#edit-kode-bendera').val();
                    let asalNegara = $('#edit-asal-negara').val();

                    $.ajax({
                        url: "{{ route('bendera.update') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            kodeBendera: kodeBendera,
                            asalNegara: asalNegara
                        },
                        success: function(data) {

                        },

                        error: function(xhr, status, error) {

                        }
                    });

                });
            }
        </script>

        @endscript