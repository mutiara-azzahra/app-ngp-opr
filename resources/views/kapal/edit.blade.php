@extends('welcome')
 
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                Ubah Data Kapal
                </h2>
            </div>
             <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('kapal.index') }}" class="btn btn-info d-none d-sm-inline-block">
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
                            <form class="card" action="{{ route('kapal.store', $data->KODE_KAPAL) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Kapal</label>
                                                <input type="text " class="form-control" name="KODE_KAPAL" value="{{ $data->KODE_KAPAL }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Call Sign</label>
                                                <input type="text" class="form-control" name="CALLSIGN" value="{{ $data->CALLSIGN }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Kapal</label>
                                                <input type="text" class="form-control" name="NAMA_KAPAL" value="{{ $data->NAMA_KAPAL }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Bendera</label>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <div>
                                                            <select name="KODE_BENDERA" id="select-tags" class="form-select">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="A">A</option>
                                                                <!-- <option value="{{ $data->KODE_BENDERA }}" {{ $data->KODE_BENDERA == available ? 'selected' : '' }}>{{ $data->KODE_BENDERA}}</option> -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Kapal</label>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <div>
                                                            <select name="JENIS_KAPAL" id="select-tags" class="form-select">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="A">A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Panjang</label>
                                                <input type="text" class="form-control" name="PANJANG" value="{{ $data->PANJANG }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Lebar</label>
                                                <input type="text" class="form-control" name="LEBAR" value="{{ $data->LEBAR }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tinggi</label>
                                                <input type="text" class="form-control" name="TINGGI" value="{{ $data->TINGGI }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Draft</label>
                                                <input type="text" class="form-control" value="{{ $data->DRAFT }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Gross Ton</label>
                                                <input type="text" class="form-control" value="{{ $data->GROSS_TON }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Dead Ton</label>
                                                <input type="text" class="form-control" value="{{ $data->DEAD_TON }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Displacement</label>
                                                <input type="text" class="form-control" value="{{ $data->DISPLACEMENT }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Mesin</label>
                                                <input type="text" class="form-control" value="{{ $data->JENIS_MESIN }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Daya Mesin</label>
                                                <input type="text" class="form-control" value="{{ $data->DAYA_MESIN }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kecepatan Maksimal</label>
                                                <input type="text" class="form-control" value="{{ $data->KECEPATAN_MAX }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kapasitas Kargo</label>
                                                <input type="text" class="form-control" value="{{ $data->KAPASITAS_KARGO }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kapasitas Penumpang</label>
                                                <input type="text" class="form-control" value="{{ $data->KAPASITAS_PENUMPANG }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Kapal</label>
                                                <div>
                                                    <select name="JENIS_KAPAL" id="select-tags" class="form-select">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="A">A</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Galangan Kapal</label>
                                                <input type="text" class="form-control" name="{{ $data->GALANGAN_KAPAL }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Klasifikasi</label>
                                                <input type="text" class="form-control" name="{{ $data->KLASIFIKASI }}" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-8">
                                        <div class="mb-3">
                                            <label class="form-label">Tahun</label>
                                            <select name="tahun" class="form-select" id="year-dropdown">    
                                            </select>
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
    let dateDropdown = document.getElementById('year-dropdown'); 
        
    let currentYear = new Date().getFullYear();    
    let earliestYear = 1970;

    while (currentYear >= earliestYear) {      
        let dateOption = document.createElement('option');          
        dateOption.text = currentYear;      
        dateOption.value = currentYear;        
        dateDropdown.add(dateOption);      
        currentYear -= 1;    
        }
</script>

@endsection