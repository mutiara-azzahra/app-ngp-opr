@extends('welcome')
 
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                Data Ownership
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
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Ownership</label>
                                                {{ $data->KODE_OS }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Kapal</label>
                                                {{ $data->KODE_KAPAL }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Class</label>
                                                {{ $data->CLASS }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Pemilik Terdaftar</label>
                                                {{ $data->NAMA_PEMILIK_TERDAFTAR }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Pemilik Manfaat</label>
                                                {{ $data->NAMA_PEMILIK_MANFAAT }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Operator Kapal</label>
                                                {{ $data->OPERATOR_KAPAL }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Operator Pihak Ketiga</label>
                                                {{ $data->OPERATOR_PIHAK_KETIGA }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Manajer Teknis</label></label>
                                                {{ $data->MANAJER_TEKNIS }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Manajer Komersial</label>
                                                {{ $data->MANAJER_KOMERSIAL }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">NPWP</label>
                                                {{ $data->NPWP }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                {{ $data->EMAIL }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Fax</label>
                                                {{ $data->FAX }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Telpon</label>
                                                {{ $data->TELPON }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Alamat</label>
                                                {{ $data->ALAMAT }}
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