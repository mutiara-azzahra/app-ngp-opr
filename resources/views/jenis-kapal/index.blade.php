@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Master Jenis Kapal</h1>
    <div class="ui divider"></div>

    <div class="column">
        <a class="ui positive button add"><i class="plus icon" style="visibility: visible;"></i> Tambah</a>
        <a class="ui negative button delete"><i class="trash icon" style="visibility: visible;"></i> Hapus</a>
        <a class="ui orange button"><i class="print icon" style="visibility: visible;"></i> Cetak</a>
    </div>
    <table class="ui compact table celled" id="tableJenisKapal">
        <thead>
            <tr>
                <th></th>
                <th class="center aligned">
                    <div class="ui checkbox">
                        <input class="ui checkbox semua" type="checkbox" tabindex="0">
                    </div>
                </th>
                <th class="center aligned">Jenis Kapal</th>
                <th class="center aligned">Grup Kapal</th>
                <th class="center aligned">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenis_kapal as $i)
            <tr id="{{ $i->FLAG_IDX }}">
                <td>{{ $no++ }}</td>
                <td class="center aligned">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" value="{{ $i->FLAG_IDX }}" name="selected_items[]" onchange="hapusCheckboxJenisKapal()">
                    </div>
                </td>
                <td class="kode">{{ $i->JENIS_KAPAL }}</td>
                <td class="asal">{{ $i->G1 }}</td>
                <td class="center aligned">
                    <button class="ui icon orange button show" id="{{ $i->FLAG_IDX }}" onclick="showDataJenisKapal(this.id)"><i class="eye icon" style="visibility: visible;"></i></button>
                    <button class="ui icon primary button edit" id="{{ $i->FLAG_IDX }}" onclick="editDataJenisKapal(this.id)"><i class="edit icon" style="visibility: visible;"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- MODAL UPDATE DATA -->
    <div class="ui modal edit">
        <div class="header">Ubah Data Jenis Kapal</div>
        <div class="content">
            <form class="ui form" action="{{ route('jenis-kapal.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label>Jenis Kapal
                        </label>
                        <input type="text" id="edit-jenis-kapal" name="jenis_kapal" readonly>
                    </div>
                    <div class="field">
                        <label>Asal Negara
                        </label>
                        <input type="text" id="edit-g1" name="g1">
                    </div>
                </div>
        </div>
        <div class=" actions">
            <button class="ui positive right labeled icon button" type="submit">
                Simpan
                <i class="checkmark icon"></i>
            </button>
        </div>
        </form>
    </div>

    <!-- MODEL ADD DATA -->
    <div class="ui modal add">
        <div class="header">Tambah Data Jenis Kapal</div>
        <div class="content">
            <form class="ui form" action="{{ route('jenis-kapal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label>Jenis Kapal
                        </label>
                        <input type="text" name="jenis_kapal" placeholder="Jenis Kapal">
                    </div>
                    <div class="field">
                        <label>Grup Kapal
                        </label>
                        <input type="text" name="g1" placeholder="Grup Kapal">
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

    <!-- MODAL SHOW DATA -->
    <div class="ui modal show" id="dataModal">
        <div class="header">Detail Data Jenis Kapal</div>
        <div class="content">
            <div class="ui form">
                <div class="field">
                    <label>Jenis Kapal</label>
                    <input type="text" id="jenis-kapal" readonly>
                </div>
                <div class="field">
                    <label>G1</label>
                    <input type="text" id="g1" readonly>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DELETE DATA -->
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
        function showDataJenisKapal(id) {

            let get = document.getElementById(id);
            let jenisKapal = get.getElementsByTagName("td")[2].innerHTML;
            let g1 = get.getElementsByTagName("td")[3].innerHTML;

            $.ajax({
                url: "{{ route('jenis-kapal.index') }}",
                type: "GET",
                data: {
                    jenisKapal: jenisKapal,
                    g1: g1,
                },
                success: function(data) {
                    $('#jenis-kapal').val(g1);
                    $('#g1').val(jenisKapal);
                },
            })
        }

        //HAPUS DATA CHECKBOXES
        function hapusCheckboxJenisKapal() {

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
                    url: "{{ route('jenis-kapal.destroy') }}",
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

        function editDataJenisKapal(id) {

            let get = document.getElementById(id);
            let jenisKapal = get.getElementsByTagName("td")[2].innerHTML;
            let g1 = get.getElementsByTagName("td")[3].innerHTML;

            $.ajax({
                url: "{{ route('bendera.index') }}",
                type: "GET",
                data: {
                    g1: g1,
                    jenisKapal: jenisKapal,
                },
                success: function(data) {
                    $('#edit-jenis-kapal').val(jenisKapal);
                    $('#edit-g1').val(g1);
                },
            })


            $('.ui.button.buttonEdit').click(function() {

                let id = $('#edit-id').val();
                let jenisKapal = $('#edit-jenis-kapal').val();
                let g1 = $('#edit-g1').val();

                $.ajax({
                    url: "{{ route('bendera.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        jenisKapal: jenisKapal,
                        g1: g1
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