@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Master Bendera</h1>
    <div class="ui divider"></div>

    <div class="column">
        <a class="ui positive button add"><i class="plus icon" style="visibility: visible;"></i> Tambah</a>
        <a class="ui negative button"><i class="trash icon" style="visibility: visible;"></i> Hapus</a>
        <a class="ui orange button"><i class="print icon" style="visibility: visible;"></i> Cetak</a>
    </div>
    <table class="ui compact table celled">
        <thead>
            <tr>
                <th></th>
                <th class="center aligned">
                    <div class="ui checkbox">
                        <input class="ui checkbox semua" type="checkbox" tabindex="0" class="hidden" onchange="hehe()">
                    </div>
                </th>
                <th class="center aligned">Kode Bendera</th>
                <th class="center aligned">Asal Negara</th>
                <th class="center aligned">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bendera as $i)
            <tr>
                <td>{{ $no++ }}</td>
                <td class="center aligned">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" class="hidden" name="selected_items[]" onchange="updateCount()">
                    </div>
                </td>
                <td>{{ $i->KODE_BENDERA }}</td>
                <td>{{ $i->ASAL_NEGARA }}</td>
                <td class="center aligned">
                    <a class="ui icon blue button"><i class="edit icon" style="visibility: visible;"></i></a>
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
                <div class="actions">
                    <div class="ui negative button">
                        Batal
                    </div>
                    <div class="ui positive right labeled icon button">
                        Ya
                        <i class="checkmark icon"></i>
                    </div>
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
        <div class="actions">
            <div class="ui negative button">
                Batal
            </div>
            <div class="ui positive right labeled icon button">
                Ya
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
</div>
@endsection