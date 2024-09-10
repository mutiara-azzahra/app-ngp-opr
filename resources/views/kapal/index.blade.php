@extends('welcome')
 
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle"></div>
                <h2 class="page-title">Master Data Kapal</h2>
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
                <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
                        </div>
                        <div>{{ $message }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
                @endif
                
                @if ($errors->any())
                <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                        </div>
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
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
                    <div class="table-responsive">
                        <div class="card-header d-flex">
                            <div class="row">
                                <!-- Refresh -->
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <button type="button" href="#" class="btn btn-info w-100" aria-label="" id="refresh-btn">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-refresh"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
                                            Muat Ulang
                                        </button>
                                    </div>
                                </div>
                                <!-- Hapus -->
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        Hapus
                                        </button>
                                    </div>
                                    <div class="modal" id="exampleModal" tabindex="-1">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <div class="modal-status bg-danger"></div>
                                                <div class="modal-body text-center py-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 9v2m0 4v.01" />
                                                    <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                                                    </svg>
                                                    <h3>Hapus data ini?</h3>
                                                    <div class="text-secondary"><span id="selectedCount">0</span> data akan dihapus dan tidak dapat kembali</div>
                                                </div>
                                                <div class="modal-footer" id="deleteButton" style="display: none">
                                                    <div class="w-100">
                                                    <div class="row">
                                                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal" type="submit">
                                                            Batal
                                                        </a></div>
                                                        <div class="col">
                                                        <form action="{{ route('kapal.destroy') }}" method="POST" id="data-table">
                                                            @csrf
                                                            <button class="btn btn-danger btn w-100" type="submit">
                                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                                Hapus Data
                                                            </button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <a href="{{ route('kapal.create') }}" class="btn btn-success w-100">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                        Tambah
                                        </a>
                                    </div>
                                </div>
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <a href="{{ route('kapal.print') }}" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modal-report">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-share-3"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 4v4c-6.575 1.028 -9.02 6.788 -10 12c-.037 .206 5.384 -5.962 10 -6v4l8 -7l-8 -7z" /></svg>
                                        Cetak
                                        </a>
                                    </div>
                                </div>
                                <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cetak Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                <label class="form-label">Jenis File</label>
                                                <select class="form-select">
                                                    <option value="1">Excel</option>
                                                    <option value="2">PDF</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                <label class="form-label">Tanggal Awal</label>
                                                <input type="date" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                <label class="form-label">Tanggal Akhir</label>
                                                <input type="date" class="form-control">
                                                </div>
                                            </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                            Batal
                                            </a>
                                            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-printer"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                                            Cetak
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table card-table table-vcenter text-nowrap datatable" id="mytable">
                            <thead>
                                <tr>
                                    <th class="text-center">Pilih</th>
                                    <th class="text-center">KODE KAPAL</th>
                                    <th class="text-center">NAMA KAPAL</th>
                                    <th class="text-center">CALL SIGN</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm" aria-label="" id="dataColumn1"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm" aria-label="" id="dataColumn2"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm" aria-label="" id="dataColumn3"></th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $i)
                                <tr>
                                    <td class="text-center">
                                        <label class="form-check">
                                            <input class="form-check-input" name="selected_items[]" value="{{ $i->KODE_KAPAL }}" id="checkbox" type="checkbox" onchange="updateCount()">
                                        </label>
                                    </td>
                                    <td class="text-left">{{ $i->KODE_KAPAL }}</td>
                                    <td class="text-left">{{ $i->NAMA_KAPAL }}</td>
                                    <td class="text-left">{{ $i->CALLSIGN }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('kapal.edit', $i->KODE_KAPAL) }}" class="btn btn-info w-5 btn-icon" aria-label="">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                        <div class="card-footer d-flex">
                            <ul class="pagination-sm m-0">
                                {!! $data->links('pagination::bootstrap-4') !!}
                            </ul>
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

// refresh table
$(document).ready(function() {

   function RefreshTable() {
       $( "#mytable" ).load( "index.php #mytable" );
   }

   $("#refresh-btn").on("click", RefreshTable);

});

// count
function updateCount() {
    const checkboxes = document.querySelectorAll('input[name="selected_items[]"]:checked');
    document.getElementById('selectedCount').textContent = checkboxes.length;

    const button = document.getElementById('deleteButton');

    console.log(checkboxes.length)

    if(checkboxes.length > 0){
        button.style.display = 'block'
    } else {
        button.style.display = 'none'
    }
}

//SEARCH PER COLUMN
// function search() {

//     console.log('1')
//     var inputRec,

//         filterRec,

//         table,
//         tr,
//         td,
//         i,
//         y,

//         Rec;
    
//     table = document.getElementById("myTable");
//     tr = table.getElementsByTagName("tr");

//     for (i = 2; i <= tr.length; i++)
//     {
//         let anySearchDoesNotMatch = false; 
//         for (y = 0; y < 4; y++) {
            
//             inputRec = document.getElementById("dataColumn"+y);

//             filterRec = inputRec.value.toUpperCase();

//             td =  tr[i].getElementsByTagName("td")[y];
            
//             if (td) {

//                 Rec = (td.textContent  || td.innerText).toUpperCase();
                
//                 if (
//                     Rec != "" && Rec.indexOf(filterRec) == -1 
//                 ) {
//                     anySearchDoesNotMatch = true;
//                 }
//             }
//         }
//         if (anySearchDoesNotMatch) {
//             tr[i].style.display = "none";
//         } else {
//             tr[i].style.display = "";
//         }
//     }
    
// }

</script>

@endsection