@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Edit Data Kapal</h1>
    <div class="ui divider hidden"></div>
    <div class="column">
        <a class="ui primary button" href="{{ route('kapal.index') }}"><i class="arrow left icon" style="visibility: visible;"></i> Kembali</a>
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
    <div class="content">
        <form class="ui form" action="{{ route('kapal.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="ui form">
                    <div class="two fields">
                        <div class="field">
                            <div class="two fields" style="padding-bottom: 15px;">
                                <div class="field">
                                    <label>Kode Kapal</label>
                                    <input type="hidden" name="flag_idx" value="{{ $data->FLAG_IDX }}">
                                    <input type="text" name="kode_kapal" value="{{ $data->KODE_KAPAL }}">
                                </div>
                                <div class="field">
                                    <label>Nama Kapal</label>
                                    <input type="text" name="nama_kapal" value="{{ $data->NAMA_KAPAL }}">
                                </div>
                            </div>
                            <div class="two fields" style="padding-bottom: 15px;">
                                <div class="field">
                                    <label>Callsign</label>
                                    <input type="text" name="callsign" value="{{ $data->CALLSIGN }}">
                                </div>
                                <div class="field">
                                    <label>Jenis Kapal</label>
                                    <div class="ui fluid search selection dropdown">
                                        <input name="jenis_kapal" type="hidden" value="{{ $data->JENIS_KAPAL }}">
                                        <i class="dropdown icon"></i>
                                        <div class="text">{{ $data->JENIS_KAPAL }}</div>
                                        <div class="menu">
                                            @foreach($jenis_kapal as $i)
                                            <div class="item" name="jenis_kapal" data-value="{{ $i->JENIS_KAPAL}}">{{ $i->JENIS_KAPAL }} / {{ $i->G1 }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="two fields" style="padding-bottom: 15px;">
                                <div class="field">
                                    <label>Bendera</label>
                                    <div class="ui fluid search selection dropdown">
                                        <input name="kode_bendera" type="hidden" value="{{ $data->KODE_BENDERA }}">
                                        <i class="dropdown icon"></i>
                                        <div class="text">{{ $data->KODE_BENDERA }}</div>
                                        <div class="menu">
                                            @foreach($bendera as $i)
                                            <div class="item" name="kode_bendera" data-value="{{ $i->KODE_BENDERA }}">{{ $i->KODE_BENDERA }} / {{ $i->ASAL_NEGARA }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Panjang</label>
                                    <input type="text" name="panjang" value="{{ $data->PANJANG }}">
                                </div>
                            </div>
                            <div class="two fields" style="padding-bottom: 15px;">
                                <div class="field">
                                    <label>Lebar</label>
                                    <input type="text" name="lebar" value="{{ $data->LEBAR }}">
                                </div>
                                <div class="field">
                                    <label>Draft</label>
                                    <input type="text" name="draft" value="{{ $data->DRAFT }}">
                                </div>
                            </div>
                            <div class="two fields" style="padding-bottom: 15px;">
                                <div class="field">
                                    <label>Tinggi</label>
                                    <input type="text" name="tinggi" value="{{ $data->TINGGI }}">
                                </div>
                                <div class="field">
                                    <label>Gross Ton</label>
                                    <input type="text" name="gross_ton" value="{{ $data->GROSS_TON }}">
                                </div>
                            </div>
                            <div class="two fields" style="padding-bottom: 15px;">
                                <div class="field">
                                    <label>Dead Ton</label>
                                    <input type="text" name="dead_ton" value="{{ $data->DEAD_TON }}">
                                </div>
                                <div class="field">
                                    <label>Displacement</label>
                                    <input type="text" name="displacement" value="{{ $data->DISPLACEMENT }}">
                                </div>
                            </div>
                            <div class="two fields" style="padding-bottom: 15px;">
                                <div class="field">
                                    <label>Jenis Mesin</label>
                                    <input type="text" name="jenis_mesin" value="{{ $data->JENIS_MESIN }}">
                                </div>
                                <div class="field">
                                    <label>Daya Mesin</label>
                                    <input type="text" name="daya_mesin" value="{{ $data->DAYA_MESIN }}">
                                </div>
                            </div>
                            <div class="two fields" style="padding-bottom: 15px;">
                                <div class="field">
                                    <label>Kecepatan Maksimal</label>
                                    <input type="text" name="kecepatan_maksimal" value="{{ $data->KECEPATAN_MAX }}">
                                </div>
                                <div class="field">
                                    <label>Kapasitas Kargo / ton</label>
                                    <input type="text" name="kapasitas_kargo" value="{{ $data->KAPASITAS_KARGO }}">
                                </div>
                            </div>
                            <div class="two fields" style="padding-bottom: 15px;">
                                <div class="field">
                                    <label>Kapasitas Penumpang</label>
                                    <input type="text" name="kapasitas_penumpang" value="{{ $data->KAPASITAS_PENUMPANG }}">
                                </div>
                                <div class="field">
                                    <label>Tahun Pembuatan Kapal</label>
                                    <div class="ui calendar" id="year_calendar">
                                        <div class="ui input left icon">
                                            <i class="calendar icon"></i>
                                            <input type="text" name="tahun_pembuatan" value="{{ $data->TAHUN_PEMBUATAN }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="two fields" style="padding-bottom: 15px;">
                                <div class="field">
                                    <label>Galangan Kapal</label>
                                    <input type="text" name="galangan_kapal" value="{{ $data->GALANGAN_KAPAL }}">
                                </div>
                                <div class="field">
                                    <label>Klasifikasi</label>
                                    <input type="text" name="klasifikasi" value="{{ $data->KLASIFIKASI }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="actions">
                <button class="ui positive button" type="submit">
                    <i class="checkmark icon" style="visibility: visible;"></i>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection