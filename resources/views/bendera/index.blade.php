@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Master Bendera</h1>
    <div class="ui divider"></div>
    <div class="ui horizontal header">
        <div class="row">
            <h4 class="ui horizontal left aligned">
                <a class="ui positive button add"><i class="plus icon" style="visibility: visible;"></i> Tambah</a>
                <a class="ui negative button delete"><i class="trash icon" style="visibility: visible;"></i> Hapus </a>
                <a class="ui orange button cetak"><i class="print icon" style="visibility: visible;"></i> Cetak </a>
            </h4>
            <h4 class="ui horizontal right aligned">
                <div class="ui right aligned">
                    <div class="ui pagination menu">
                        <a class="active item">
                            1
                        </a>
                        <div class="disabled item">
                            ...
                        </div>
                        <a class="item">
                            10
                        </a>
                        <a class="item">
                            11
                        </a>
                        <a class="item">
                            12
                        </a>
                    </div>
                </div>
            </h4>
        </div>
    </div>


    <div class="ui divider"></div>
    <div id="alert"></div>
    <table class="ui compact table celled">
        <thead>
            <tr>
                <th class="center aligned">
                </th>
                <th class="center aligned">Kode Bendera</th>
                <th class="center aligned">Asal Negara</th>
                <th class="center aligned">Aksi</th>
            </tr>
        </thead>

        <tbody id="table-bendera">
            @foreach($bendera as $i)
            <tr id="index_{{ $i->FLAG_IDX }}">
                <td class="center aligned">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" value="{{ $i->FLAG_IDX }}" name="selected_items[]" onchange="pilihDataBendera(this.val)">
                    </div>
                </td>
                <td>{{ $i->KODE_BENDERA }}</td>
                <td>{{ $i->ASAL_NEGARA }}</td>
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
                <div class="two fields">
                    <div class="field">
                        <label>Kode Bendera
                            <input type="text" id="kode-bendera" name="kode_bendera" placeholder="Kode Bendera">
                        </label>
                    </div>
                    <div class="field">
                        <label>Asal Negara
                            <input type="text" id="asal-negara" name="asal_negara" placeholder="Asal Negara">
                        </label>
                    </div>
                </div>
        </div>
        <div class="actions">
            <button class="ui positive right labeled icon button" onclick="addDataBendera()" type="submit">
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
        function addDataBendera() {
            event.preventDefault();

            let token = "{{ csrf_token() }}"
            let kode_bendera = $('#kode-bendera').val();
            let asal_negara = $('#asal-negara').val();

            $.ajax({
                url: "{{ route('bendera.store') }}",
                type: "POST",
                data: {
                    kode_bendera: kode_bendera,
                    asal_negara: asal_negara,
                    _token: token
                },
                success: function(response) {

                    let post = (`
                    <tr id="index_${response.data.FLAG_IDX}">
                        <td class="center aligned">
                            <div class="ui checkbox">
                                <label><input type="checkbox" tabindex="0" value="${response.data.FLAG_IDX}" name="selected_items[]" onchange="pilihDataBendera(this.value)"></label>
                            </div>
                        </td>
                        <td>${response.data.KODE_BENDERA}</td>
                        <td>${response.data.ASAL_NEGARA}</td>
                        <td class="center aligned">
                            <button class="ui icon orange button show" id="${response.data.FLAG_IDX}" onclick="showDataBendera(this.id)"><i class="eye icon" style="visibility: visible;"></i></button>
                            <button class="ui icon primary button edit" id="${response.data.FLAG_IDX}" onclick="editDataBendera(this.id)"><i class="edit icon" style="visibility: visible;"></i></button>
                        </td>
                    </tr>`)

                    $('#table-bendera').prepend(post);

                    $('.ui.button.show').click(function() {
                        $('.ui.modal.show').modal('show');
                    });

                    $('.ui.button.edit').click(function() {
                        $('.ui.modal.edit').modal('show');
                    });

                    $('.ui.modal.add').modal('hide');

                    $('#kode-bendera').val('');
                    $('#asal-negara').val('');
                }
            });
        }

        function showDataBendera(id) {

            let token = "{{  csrf_token() }}";

            $.ajax({
                url: "{{ route('bendera.show') }}",
                type: "GET",
                data: {
                    id: id,
                    _token: token
                },
                success: function(response) {
                    $('#result-show').html(`
                    <div class="ui form">
                            <div class="two fields">
                                <div class="field">
                                    <label>Kode Bendera
                                        <p>${response.KODE_BENDERA}</p>
                                    </label>
                                </div>
                                <div class="field">
                                    <label>Asal Negara
                                        <p>${response.ASAL_NEGARA}</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    `)
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

            //Hapus Data Checked
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
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        hapus_data: datas_id,
                        _token: token
                    },
                    success: function(response) {},

                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                    }
                });
            });

            //Cetak Data Checked
            $('.ui.button.buttonCetak').click(function() {

                $.ajax({
                    url: "{{ route('bendera.print') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        checked_data: datas_id,
                        _token: token
                    },
                    success: function(response) {

                        console.log(response.checked_data)

                    },

                    error: function(xhr, status, error) {
                        console.error("Gagal mengambil data: ", error);
                    }
                });
            });
        }

        function editDataBendera(id) {

            let token = "{{ csrf_token() }}";

            $.ajax({
                url: "{{ route('bendera.edit') }}",
                type: "GET",
                data: {
                    id: id,
                    _token: token
                },
                success: function(response) {
                    $('#result-edit').html(`
                    <div class="ui form">
                        <div class="two fields">
                            <div class="field">
                                <label>Kode Bendera
                                    <input type="text" id="edit-kode-bendera" name="kode_bendera" value="${response.KODE_BENDERA}">
                                    <input type="hidden" id="edit-id" name="id" value="${response.FLAG_IDX}">
                                </label>
                            </div>
                            <div class="field">
                                <label>Asal Negara
                                    <input type="text" id="edit-asal-negara" name="asal_negara" value="${response.ASAL_NEGARA}">
                                </label>
                            </div>
                        </div>
                    </div>`)
                },
                error: function(xhr, status, error) {
                    console.error("Gagal mengambil data:", error);
                }
            })

            $('.ui.button.buttonUpdate').click(function() {

                let id = $('#edit-id').val();
                let kode_bendera = $('#edit-kode-bendera').val();
                let asal_negara = $('#edit-asal-negara').val();
                let token = "{{ csrf_token() }}";

                $.ajax({
                    url: "{{ route('bendera.update') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
                        kode_bendera: kode_bendera,
                        asal_negara: asal_negara,
                        _token: token
                    },
                    success: function(response) {
                        let post = (` 
                            <tr id="index_${response.data.id}">
                                <td class="center aligned">
                                    <div class="ui checkbox">
                                        <label><input type="checkbox" tabindex="0" value="${response.data.id}" name="selected_items[]" onchange="pilihDataBendera(this.val)"></label>
                                    </div>
                                </td>
                                <td>${response.data.kode_bendera}</td>
                                <td>${response.data.asal_negara}</td>
                                <td class="center aligned">
                                    <button class="ui icon orange button show" id="${response.data.id}" onclick="showDataBendera(this.id)"><i class="eye icon" style="visibility: visible;"></i></button>
                                    <button class="ui icon primary button edit" id="${response.data.id}" onclick="editDataBendera(this.id)"><i class="edit icon" style="visibility: visible;"></i></button>
                                </td>
                            </tr>`)

                        $(`#index_${response.data.id}`).replaceWith(post)

                        $('.ui.button.show').click(function() {
                            $('.ui.modal.show').modal('show');
                        });

                        $('.ui.button.edit').click(function() {
                            $('.ui.modal.edit').modal('show');
                        });

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