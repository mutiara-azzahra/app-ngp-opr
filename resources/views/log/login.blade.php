@extends('welcome')
 
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
            <!-- Page pre-title -->
            <!-- <div class="page-pretitle"></div>
                <h2 class="page-title">Master Data Karyawan</h2>
            </div> -->
            <!-- Page title actions -->
            <!-- <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="" class="btn btn-warning d-none d-sm-inline-block" target="_blank">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-printer"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                    Cetak
                    </a>
                </div>
            </div> -->
            <!-- <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Tambah Data
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                @if ($message = Session::get('success'))
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                        </div>
                        <div>{{ $message }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
                @elseif ($message = Session::get('danger'))
                <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                        </div>
                        <div>{{ $message }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
                @endif
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <div class="ms-auto text-secondary">
                            Cari:
                            <div class="ms-2 d-inline-block">
                            <input type="text" class="form-control form-control-sm" aria-label="" id="searchInput">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable" id="dataTable">
                            <thead>
                                <tr>
                                    <th class="text-center">LOG TIME</th>
                                    <th class="text-center">KODE APLIKASI</th>
                                    <th class="text-center">KODE COMPANY</th>
                                    <th class="text-center">KETERANGAN</th>
                                    <th class="text-center">HOSTNAME</th>
                                    <th class="text-center">IP ADDRESS</th>
                                    <th class="text-center">MAC ADDRESS</th>
                                    <th class="text-center">NAMA</th>
                                    <th class="text-center">ACT1</th>
                                    <th class="text-center">ACT2</th>
                                    <th class="text-center">ACT3</th>
                                    <th class="text-center">ACT4</th>
                                    <th class="text-center">ACT5</th>
                                    <th class="text-center">ACT6</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($log_login as $i)
                                <tr>
                                    <td class="text-left">{{ $i->LOGTIME }}</td>
                                    <td class="text-left">{{ $i->KODE_APP }}</td>
                                    <td class="text-left">{{ $i->KODE_COMPANY }}</td>
                                    <td class="text-left">{{ $i->APP_TITLE }}</td>
                                    <td class="text-left">{{ $i->HOSTNAME }}</td>
                                    <td class="text-left">{{ $i->IPADDRESS }}</td>
                                    <td class="text-left">{{ $i->MACADDRESS }}</td>
                                    <td class="text-left">{{ $i->USERNAME }}</td>
                                    <td class="text-left">{{ $i->ACT1 }}</td>
                                    <td class="text-left">{{ $i->ACT2 }}</td>
                                    <td class="text-left">{{ $i->ACT3 }}</td>
                                    <td class="text-left">{{ $i->ACT4 }}</td>
                                    <td class="text-left">{{ $i->ACT5 }}</td>
                                    <td class="text-left">{{ $i->ACT6 }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
</div>
@endsection

@section('script')

@endsection