@extends('welcome')
 
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                Data Kapal
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
                @if($message = Session::get('success'))
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
                        </div>
                        <div>{{ $message }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
                @elseif($message = Session::get('danger'))
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
                        </div>
                        <div>{{ $message }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
                        </div>
                        <div>
                            <ul>
                                <strong>Maaf!</strong> Ada yang salah<br><br>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="col-lg-8 col-lg-12">
                        <div class="row row-cards">
                            <div class="col-12">
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Kapal</label>
                                                {{ $data->KODE_KAPAL }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Call Sign</label>
                                                {{ $data->CALLSIGN }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Kapal</label>
                                                {{ $data->NAMA_KAPAL }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Asal Negara</label>
                                                {{ $data->KODE_BENDERA }}/{{ $data->bendera->ASAL_NEGARA }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Kapal</label>
                                                {{ $data->JENIS_KAPAL }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Panjang / m²</label>
                                                {{ $data->KODE_KAPAL }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Lebar / m²</label>
                                                {{ $data->LEBAR }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tinggi / m²</label></label>
                                                <{{ $data->TINGGI }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Draft / m</label>
                                                {{ $data->DRAFT }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Gross Tonnage (GT) / m³</label>
                                                {{ $data->GROSS_TON }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Dead Tonnage (DT) / m³</label>
                                                {{ $data->DEAD_TON }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Displacement / m³</label>
                                                {{ $data->DISPLACEMENT }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Mesin</label>
                                                {{ $data->JENIS_MESIN }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Daya Mesin / kW</label>
                                                {{ $data->DAYA_MESIN }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kecepatan Maksimal</label>
                                                {{ $data->KODE_KAPAL }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kapasitas Kargo</label>
                                                {{ $data->KAPASITAS_KARGO }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Kapasitas Penumpang</label>
                                                {{ $data->KAPASITAS_PENUMPANG }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Galangan Kapal</label>
                                                {{ $data->GALANGAN_KAPAL }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Klasifikasi</label>
                                                {{ $data->KLASIFIKASI }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tahun Pembuatan Kapal</label>
                                                {{ $data->TAHUN_PEMBUATAN }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
// YEAR DROPDOWN
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

//CHECK INPUT NUMBER ONLY
document.addEventListener('DOMContentLoaded', function() {
    const decimalRegex = /^\d*(\.\d*)?$/;

    document.querySelectorAll('.data-input').forEach(input => {
        input.addEventListener('input', function() {
            const inputValue = this.value;
            const errorMessage = this.parentElement.querySelector('.error-message');

            if (!decimalRegex.test(inputValue)) {
                errorMessage.style.display = 'inline';
                errorMessage.style.color = 'red';
            } else {
                errorMessage.style.display = 'none';
            }
        });
    });
});

</script>

@endsection