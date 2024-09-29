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
    <div class="ui divider"></div>

    <div id="alert"></div>

    <table class="ui compact table celled" id="tableBendera">
        <thead>
            <tr>
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
            <tr id="index_{{ $i->FLAG_IDX }}">
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

    <!-- MODAL ADD DATA BENDERA -->
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
    <div class="ui modal show">
        <div class="header">Tampil Data Bendera</div>
        <div class="content" id="result-show"></div>
    </div>

    <!-- MODAL EDIT DATA -->
    <div class="ui modal edit">
        <div class="header">Ubah Data Bendera</div>
        <div class="content" id="result-edit">

        </div>
        <div class=" actions">
            <button class="ui positive right labeled icon button buttonUpdate" type="submit">
                Simpan
                <i class="checkmark icon"></i>
            </button>
        </div>
        </form>
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
        function showDataBendera(id) {
            $.ajax({
                url: "{{ route('bendera.show') }}",
                type: "GET",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#result-show').html(`
                        <div class="ui form">
                            <div class="two fields">
                                <div class="field">
                                    <label>Kode Bendera</label>
                                    <p>${response.KODE_BENDERA}</p>
                                </div>
                                <div class="field">
                                    <label>Asal Negara</label>
                                    <p>${response.ASAL_NEGARA}</p>
                                </div>
                            </div>
                        </div>`)
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data: ", error);
                }
            })
        }

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

            $.ajax({
                url: "{{ route('bendera.show') }}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#result-edit').html(`
                    <div class="ui form">
                        <div class="two fields">
                            <div class="field">
                                <label>Kode Bendera
                                </label>
                                <input type="text" id="edit-kode-bendera" name="kode_bendera" value="${response.KODE_BENDERA}">
                                <input type="hidden" id="edit-id" name="id" value="${response.FLAG_IDX}">
                            </div>
                            <div class="field">
                                <label>Asal Negara
                                </label>
                                <input type="text" id="edit-asal-negara" name="asal_negara" value="${response.ASAL_NEGARA}">
                            </div>
                        </div>
                    </div>`)
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data: ", error);
                }
            })

            $('.ui.button.buttonUpdate').click(function() {

                let id = $('#edit-id').val();
                let kode_bendera = $('#edit-kode-bendera').val();
                let asal_negara = $('#edit-asal-negara').val();

                $.ajax({
                    url: "{{ route('bendera.update') }}",
                    type: "GET",
                    data: {
                        id: id,
                        kode_bendera: kode_bendera,
                        asal_negara: asal_negara,
                    },
                    success: function(response) {

                        $(document).on('click', '.show', function() {
                            showDataBendera(this.id);
                        });

                        $(document).on('click', '.edit', function() {
                            editDataBendera(this.id);
                        });

                        let post = `
                        <tr id="index_${response.data.id}">
                            <td class="center aligned">
                                <div class="ui checkbox">
                                    <input type="checkbox" tabindex="0" value="${response.data.id}" name="selected_items[]" onchange="pilihDataBendera(this.val)" name="_method">
                                </div>
                            </td>
                            <td class="kode">${response.data.kode_bendera}</td>
                            <td class="asal">${response.data.asal_negara}</td>
                            <td class="center aligned">
                                <button class="ui icon orange button show" id="${response.data.id}"><i class="eye icon" style="visibility: visible;"></i></button>
                                <button class="ui icon primary button edit" id="${response.data.id}"><i class="edit icon" style="visibility: visible;"></i></button>
                            </td>
                        </tr>`;

                        $(`#index_${response.data.id}`).replaceWith(post)

                    },
                    error: function(xhr, status, error) {
                        $('#alert').html(`
                        <div class="ui negative message">
                            <i class="close icon"></i>
                            <div class="header">
                                Data tersimpan
                            </div>
                            <p>${response.message}</p>
                        </div>`);
                    }
                })
            })
        }
    </script>

    @endscript