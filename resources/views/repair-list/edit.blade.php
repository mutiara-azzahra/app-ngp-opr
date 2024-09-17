@extends('welcome')
 
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                Jenis Data Kapal
                </h2>
            </div>
             <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('repair-list.index') }}" class="btn btn-info d-none d-sm-inline-block">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                    Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="col-lg-8 col-lg-12">
                        <div class="row row-cards">
                            <div class="col-12">
                            <form class="card" action="{{ route('repair-list.store', $data->FLAG_IDX) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row row-cards">
                                    <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Repair List</label>
                                                <input type="text" class="form-control" name="kode_repair_list" value="{{ $data->KODE_REPAIR_LIST }}" placeholder="Isi Kode Repair List">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Kapal</label>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <div>
                                                            <select type="text" name="jenis_kapal"  id="jenis_kapal" class="form-select">
                                                                <option value="">-- Pilih --</option>
                                                                @foreach($jenis_kapal as $a)
                                                                    <option value="{{ $a->JENIS_KAPAL }}" {{ $data->JENIS_KAPAL == $a->JENIS_KAPAL ? 'selected' : '' }}>{{ $a->JENIS_KAPAL }} /{{ $a->G1 }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Bagian Kapal</label>
                                                <input type="text" class="form-control" value="{{ $data->BAGIAN_KAPAL }}" placeholder="Isi bagian kapal">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Perbaikan</label>
                                                <input type="text" class="form-control" value="{{ $data->JENIS_PERBAIKAN }}" placeholder="Isi jenis perbaikan">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control" value="{{ $data->DESKRIPSI }}" placeholder="Isi deskripsi">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Lama Pengerjaan</label>
                                                <input type="number" class="form-control" value="{{ $data->INTERVAL_WAKTU_HARI }}" placeholder="Isi lama perngerjaan dalam satuan hari">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">HPP</label>
                                                <input type="text" class="form-control" value="{{ $data->HPP }}" placeholder="Isi HPP">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Satuan</label>
                                                <input type="text" class="form-control" value="{{ $data->SATUAN }}" placeholder="Isi satuan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-success">Simpan Data</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
//JENIS KAPAL
document.addEventListener("DOMContentLoaded", function () {
    var el;
    window.TomSelect && (new TomSelect(el = document.getElementById("jenis_kapal"), {
        copyClassesToDropdown: false,
        dropdownParent: 'body',
        controlInput: '<input>',
        render:{
            item: function(data,escape) {
                if( data.customProperties ){
                    return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                }
                return '<div>' + escape(data.text) + '</div>';
            },
            option: function(data,escape){
                if( data.customProperties ){
                    return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                }
                return '<div>' + escape(data.text) + '</div>';
            },
        },
    }));
});
</script>
@endsection