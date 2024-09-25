@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Master Bendera</h1>
    <div class="ui divider"></div>

    <div class="column">
        <a class="ui positive button add"><i class="plus icon" style="visibility: visible;"></i> Tambah</a>
        <a class="ui negative button delete"><i class="trash icon" style="visibility: visible;"></i> Hapus</a>
        <a class="ui orange button"><i class="print icon" style="visibility: visible;"></i> Cetak</a>
    </div>
    <table class="ui compact table celled">
        <thead>
            <tr>
                <th></th>
                <th class="center aligned">
                    <div class="ui checkbox">
                        <input class="ui checkbox semua" type="checkbox" tabindex="0">
                    </div>
                </th>
                <th class="center aligned">Kode Bendera</th>
                <th class="center aligned">Asal Negara</th>
                <th class="center aligned">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bendera as $i)
            <tr id="{{ $i->FLAG_IDX }}" value="{{ $i->KODE_BENDERA }}">
                <td>{{ $no++ }}</td>
                <td class="center aligned">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" value="{{ $i->FLAG_IDX }}" name="selected_items[]" onchange="hapusCheckboxBendera()">
                    </div>
                </td>
                <td class="kode">{{ $i->KODE_BENDERA }}</td>
                <td class="asal">{{ $i->ASAL_NEGARA }}</td>
                <td class="center aligned">
                    <button class="ui icon orange button show" id="{{ $i->FLAG_IDX }}" onclick="showDataBendera(this)"><i class="eye icon" style="visibility: visible;"></i></button>
                    <button class="ui icon blue button edit" id="{{ $i->FLAG_IDX }}" onclick="editDataBendera(this)"><i class="edit icon" style="visibility: visible;"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- MODAL ADD DATA -->
    <div class="ui modal add">
        <div class="header">Tambah Data Bendera</div>
        <div class="content">
            <form class="ui form" action="{{ route('bendera.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label>Kode Bendera
                        </label>
                        <input type="text" name="kode_bendera" placeholder="Kode Bendera">
                    </div>
                    <div class="field">
                        <label>Asal Negara
                        </label>
                        <input type="text" name="asal_negara" placeholder="Asal Negara">
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
        <div class="header">Detail Data Bendera</div>
        <div class="content" id="modal-content">

        </div>

    </div>

    <!-- MODAL EDIT DATA -->
    <div class="ui modal edit" id="{{ $i->FLAG_IDX }}">
        <div class="header">Ubah Data Kapal</div>
        <div class="content">
            <form class="ui form" action="{{ route('bendera.update', $i->FLAG_IDX) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label>Kode Bendera
                        </label>
                        <input type="text" value="{{ $i->FLAG_IDX }}" name="kode_bendera" placeholder="Kode Bendera">
                    </div>
                    <div class="field">
                        <label>Asal Negara
                        </label>
                        <input type="text" value="{{ $i->ASAL_NEGARA }}" name="asal_negara" placeholder="Asal Negara">
                    </div>
                </div>
        </div>
        <div class="actions">
            <button class="ui primary deny button">
                Batal
            </button>
            <button class="ui positive right labeled icon button buttonEdit" type="submit">
                Simpan
                <i class="checkmark icon"></i>
            </button>
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

<!-- MODAL CETAK DATA -->
<div class="ui modal cetak">
    <div class="header">Cetak Data Bendera</div>
    <div class="content">
        <form class="ui form" action="{{ route('bendera.print') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="field">
                <label>Kode Bendera
                </label>
                <input type="text" name="kode_bendera" placeholder="Kode Bendera">
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
</div>
@endsection


@script

<script>
    function showDataBendera(button) {

        const detail = $(button).attr('id');
        const data = document.getElementById(detail);
        const kodeBendera = data.getElementsByTagName("td")[2].innerHTML;
        const asalNegara = data.getElementsByTagName("td")[3].innerHTML;

        $('.show').click(function() {
            $.ajax({
                url: "{{ route('bendera.index') }}",
                type: "GET",
                data: {
                    detail: detail,
                    asalNegara: asalNegara,
                    kodeBendera: kodeBendera,
                },
                success: function(detail) {
                    $('#modal-content').html(`
                <div class="two fields">
                    <div class="field">
                        <label>Kode Bendera</label>
                        <p>${kodeBendera}</p>
                    </div>
                    <div class="field">
                        <label>Asal Negara</label>
                        <p>${asalNegara}</p>
                    </div>
                </div>
            `);
                },
            });
        });
    };

    //EDIT DATA BY ID
    function editDataBendera(button) {

        const data = $(button).attr('id');
        $('.ui.button.buttonEdit').click(function() {

            $.ajax({
                url: "{{ route('bendera.update', $i->FLAG_IDX) }}",
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

    //HAPUS DATA CHECKBOXES
    function hapusCheckboxBendera() {

        const id = []

        $('input[name="selected_items[]"]:checked').each(function(i) {
            id[i] = $(this).val();

        });

        $('.ui.button.buttonHapus').click(function() {

            id.forEach(function(element) {
                const el = document.getElementById(element);

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
</script>

@endscript