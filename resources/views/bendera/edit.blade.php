@extends('welcome')
 
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                Ubah Data Bendera
                </h2>
            </div>
             <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('bendera.index') }}" class="btn btn-info d-none d-sm-inline-block">
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
                @if (($message = Session::get('danger')) && ($errors->any()))
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
                <div class="card">
                    <div class="col-lg-8 col-lg-12">
                        <div class="row row-cards">
                            <div class="col-12">
                            <form class="card" action="{{ route('bendera.update', $data->FLAG_IDX) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Bendera</label>
                                                <input type="text " class="form-control" name="kode_bendera" value="{{ $data->KODE_BENDERA }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Asal Negara</label>
                                                <input type="text" class="form-control" name="asal_negara" value="{{ $data->ASAL_NEGARA }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Catatan *opsional</label>
                                                <input type="text" class="form-control" name="note" value="{{ $data->NOTE }}">
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



        function updateCount() {

const checkedValue = $('input[name="selected_items[]"]:checked').val();
const checkboxes = document.querySelectorAll('input[name="selected_items[]"]:checked');
document.getElementById('selectedCount').textContent = checkboxes.length;

const button = document.getElementById('deleteButton');

if(checkboxes.length > 0){
    button.style.display = 'block'
} else {
    button.style.display = 'none'
}

$('#coba').click(function(){  
    $.ajax({  
        url     :"{{ route('bendera.destroy') }}",  
        method  :"POST",  
        data    :{ checkedValue },  
        success : (response) => {
            alert('Form submitted successfully');
        }  error:  (response) => {
            alert('Error');
        }
    });  
});
}
</script>

@endsection