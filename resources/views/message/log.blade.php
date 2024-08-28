@extends('welcome')
 
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle"></div>
                <h2 class="page-title">DATA LOG MESSAGE</h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('message.index') }}" class="btn btn-success d-none d-sm-inline-block" target="_blank">
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                        </div>
                        <div>{{ $message }}</div>
                        <p>{{ $error }}</p>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
                @endif
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-header d-flex">
                            <div class="ms-auto text-secondary">
                                Cari:
                                <div class="ms-2 d-inline-block">
                                <input type="text" class="form-control form-control-sm" aria-label="" id="searchInput">
                                </div>
                            </div>
                        </div>
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
                                @foreach ($data as $i)
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

@endsection

@section('script')

<script>

</script>

@endsection