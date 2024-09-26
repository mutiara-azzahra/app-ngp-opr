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
    <table class="ui compact table celled" id="tableBendera">
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
            <tr id="{{ $i->FLAG_IDX }}">
                <td>{{ $no++ }}</td>
                <td class="center aligned">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" value="{{ $i->FLAG_IDX }}" name="selected_items[]" onchange="pilihDataBendera(this.val)" name="_method">
                    </div>
                </td>
                <td class="kode">{{ $i->KODE_BENDERA }}</td>
                <td class="asal">{{ $i->ASAL_NEGARA }}</td>
                <td class="center aligned">
                    <button class="ui icon orange button show" id="{{ $i->FLAG_IDX }}" onclick="showDataBendera(this.id)"><i class="eye icon" style="visibility: visible;"></i></button>
                    <button class="ui icon primary button edit" id="{{ $i->FLAG_IDX }}" onclick="editDataBendera(this.id)"><i class="edit icon" style="visibility: visible;"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- MODAL ADD DATA -->
    <div class="ui modal edit">
        <div class="header">Ubah Data Bendera</div>
        <div class="content">
            <form class="ui form" action="{{ route('bendera.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label>Kode Bendera
                        </label>
                        <input type="text" id="edit-kode-bendera" name="kode_bendera" readonly>
                    </div>
                    <div class="field">
                        <label>Asal Negara
                        </label>
                        <input type="text" id="edit-asal-negara" name="asal_negara">
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
        <div class="content">
            <div class="ui form">
                <div class="field">
                    <label>Kode Bendera</label>
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
        function showDataBendera(id) {

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

        //PILIH CHECKBOX
        function pilihDataBendera(id) {

            let datas_id = [];

            $('input[name="selected_items[]"]:checked').each(function(i) {
                datas_id[i] = parseInt($(this).val());
            });

            $('.ui.button.buttonHapus').click(function() {

                datas_id.forEach(function(element) {
                    let el = document.getElementById(element);
                    if (el) {
                        el.remove();
                    }
                });

                $.ajax({
                    url: "{{ route('bendera.destroy') }}",
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

        function editDataBendera(id) {

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