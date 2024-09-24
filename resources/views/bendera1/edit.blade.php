@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Master Bendera</h1>
    <div class="ui divider"></div>

    <div class="column">
        <a class="ui positive button add"><i class="plus icon" style="visibility: visible;"></i> Tambah</a>
        <a class="ui negative button delete"><i class="trash icon" style="visibility: visible;" id="buttonHapus"></i> Hapus</a>
        <a class="ui orange button"><i class="print icon" style="visibility: visible;"></i> Cetak</a>
    </div>
    <table class="ui compact table celled">
        <thead>
            <tr>
                <th></th>
                <th class="center aligned">Kode Bendera</th>
                <th class="center aligned">Asal Negara</th>
                <th class="center aligned">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr id="DELETE">
                <td>A</td>
                <td>A</td>
                <td>A</td>
                <td class="center aligned">
                    <a class="ui icon blue button"><i class="edit icon" style="visibility: visible;"></i></a>
                </td>
            </tr>
            <tr id="DELETE1">
                <td>B</td>
                <td>B</td>
                <td>B</td>
                <td class="center aligned">
                    <a class="ui icon blue button"><i class="edit icon" style="visibility: visible;"></i></a>
                </td>
            </tr>
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
    <div class="ui modal show">
        <div class="header">Detail Data Bendera</div>
        <div class="content">
            <div class="two fields">
                <div class="field">
                    <label>Kode Bendera</label>
                    <span class="ui red text"></span>
                </div>
                <div class="field">
                    <label>Asal Negara</label>
                    <span class="ui red text"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT DATA -->
    <div class="ui modal edit">
        <div class="header">Ubah Data Kapal</div>
        <div class="content">
            <form class="card" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label>Kode Bendera
                        </label>
                        <input type="text" name="kode_bendera" value="">
                    </div>
                    <div class="field">
                        <label>Asal Negara
                        </label>
                        <input type="text" name="asal_negara" value="">
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
        <div class="actions" id="deleteButton">
            <button class="ui primary deny button">
                Batal
            </button>
            <button class="ui negative icon button buttonHapus" onclick="tes()">
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
    function tes() {

        document.getElementById("DELETE").remove();
    }
</script>

@endscript