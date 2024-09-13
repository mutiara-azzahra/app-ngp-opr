@extends('welcome')
 
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                Ubah Data Ownership
                </h2>
            </div>
             <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('ownership.index') }}" class="btn btn-info d-none d-sm-inline-block">
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
                            <form class="card" action="{{ route('ownership.update', $data->FLAG_IDX) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Ownership</label>
                                                <input type="text " class="form-control" name="kode_os" value="{{ $data->KODE_OS }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Pilih Kapal</label>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <div>
                                                            <select name="kapal" id="kapal" class="form-select">
                                                                <option value="">-- Pilih --</option>
                                                                @foreach($kapal as $a)
                                                                    <option value="{{ $a->KODE_KAPAL }}" {{ $data->KODE_KAPAL == $a->KODE_KAPAL ? 'selected' : '' }}>{{ $a->KODE_KAPAL }} / {{ $a->NAMA_KAPAL }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Class</label>
                                                <input type="text" class="form-control" name="class" value="{{ $data->CLASS }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Nam Pemilik Terdaftar</label>
                                                <input type="text" class="form-control" name="nama_pemilik_terdaftar" value="{{ $data->NAMA_PEMILIK_TERDAFTAR }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Pemilik Manfaat</label>
                                                <input type="text" class="form-control" name="nama_pemilik_manfaat" value="{{ $data->NAMA_PEMILIK_MANFAAT }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Operator Kapal</label>
                                                <input type="text" class="form-control" name="operator_kapal" value="{{ $data->OPERATOR_KAPAL }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Operator Pihak Ketiga</label>
                                                <input type="text" class="form-control" value="{{ $data->OPERATOR_PIHAK_KETIGA }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Manajer Teknis</label>
                                                <input type="text" class="form-control" value="{{ $data->MANAJER_TEKNIS }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Manajer Komersial</label>
                                                <input type="text" class="form-control" value="{{ $data->MANAJER_KOMERSIAL }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">NPWP</label>
                                                <input type="text" class="form-control" value="{{ $data->NPWP }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" value="{{ $data->EMAIL }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Fax</label>
                                                <input type="text" class="form-control" value="{{ $data->FAX }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Telpon</label>
                                                <input type="text" class="form-control" value="{{ $data->TELPON }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Alamat</label>
                                                <input type="text" class="form-control" value="{{ $data->ALAMAT }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-success">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>        
                                    Simpan Data</button>
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
        window.TomSelect && (new TomSelect(el = document.getElementById("kapal"), {
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