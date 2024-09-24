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
                    <a href="{{ route('bendera.index') }}" class="btn btn-info d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 9v4" />
                                <path d="M12 16v.01" />
                            </svg>
                        </div>
                        <div>{{ $message }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
                @elseif($message = Session::get('danger'))
                <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 9v4" />
                                <path d="M12 16v.01" />
                            </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 9v4" />
                                <path d="M12 16v.01" />
                            </svg>
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
                                <form class="card" action="{{ route('bendera.update', $data->KODE_BENDERA) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row row-cards">
                                            <div class="col-sm-6 col-md-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kode Bendera</label>
                                                    <input type="text " class="form-control" name="kode_bendera" value="{{ $data->KODE_KAPAL }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Call Sign</label>
                                                    <input type="text" class="form-control" name="callsign" value="{{ $data->CALLSIGN }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Kapal</label>
                                                    <input type="text" class="form-control" name="nama_kapal" value="{{ $data->NAMA_KAPAL }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Bendera</label>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <div>
                                                                <select type="text" name="kode_bendera" id="bendera" class="form-select">
                                                                    <option value="">-- Pilih --</option>
                                                                    @foreach($bendera as $a)
                                                                    <option value="{{ $a->KODE_BENDERA }}" {{ $data->KODE_BENDERA == $a->KODE_BENDERA ? 'selected' : '' }}>{{ $a->KODE_BENDERA }}/{{ $a->ASAL_NEGARA }}</option>
                                                                    @endforeach
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
                                                                <select name="jenis_kapal" id="jenis_kapal" class="form-select">
                                                                    <option value="">-- Pilih --</option>
                                                                    @foreach($jenis_kapal as $a)
                                                                    <option value="{{ $a->JENIS_KAPAL }}" {{ $data->JENIS_KAPAL == $a->JENIS_KAPAL ? 'selected' : '' }}>{{ $a->JENIS_KAPAL }} / {{ $a->G1 }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Panjang <span class="error-message" style="display: none">*wajib angka, desimal menggunakan "." (titik)</span></label>
                                                    <input type="text" class="form-control data-input" name="panjang" value="{{ $data->PANJANG }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Kapasitas Kargo <span class="error-message" style="display: none">*wajib angka, desimal menggunakan "." (titik)</span></label>
                                                    <input type="text" class="form-control data-input" name="kapasitas_kargo" value="{{ $data->KAPASITAS_KARGO }}" placeholder="0">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Lebar</label>
                                                    <input type="text" class="form-control data-input" name="lebar" value="{{ $data->LEBAR }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Tinggi</label>
                                                    <input type="text" class="form-control data-input" name="tinggi" value="{{ $data->TINGGI }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Draft</label>
                                                    <input type="text" class="form-control data-input" name="draft" value="{{ $data->DRAFT }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Gross Ton</label>
                                                    <input type="text" class="form-control data-input" name="gross_ton" value="{{ $data->GROSS_TON }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Dead Ton</label>
                                                    <input type="text" class="form-control data-input" name="dead_ton" value="{{ $data->DEAD_TON }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Displacement</label>
                                                    <input type="text" class="form-control data-input" name="displacement" value="{{ $data->DISPLACEMENT }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Mesin</label>
                                                    <input type="text" class="form-control" name="jenis_mesin" value="{{ $data->JENIS_MESIN }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Daya Mesin</label>
                                                    <input type="text" class="form-control data-input" name="daya_mesin" value="{{ $data->DAYA_MESIN }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Kecepatan Maksimal</label>
                                                    <input type="text" class="form-control data-input" name="kecepatan_max" value="{{ $data->KECEPATAN_MAX }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Kapasitas Kargo</label>
                                                    <input type="text" class="form-control data-input" name="kapasitas_kargo" value="{{ $data->KAPASITAS_KARGO }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Kapasitas Penumpang</label>
                                                    <input type="text" class="form-control" name="kapasitas_penumpang" value="{{ $data->KAPASITAS_PENUMPANG }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Galangan Kapal</label>
                                                    <input type="text" class="form-control" name="galangan_kapal" value="{{ $data->GALANGAN_KAPAL }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Klasifikasi</label>
                                                    <input type="text" class="form-control" name="klasifikasi" value="{{ $data->KLASIFIKASI }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Tahun</label>
                                                    <select name="tahun_pembuatan" class="form-select" id="year-dropdown">
                                                        <option value="{{ $data->TAHUN_PEMBUATAN }}">{{ $data->TAHUN_PEMBUATAN }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M14 4l0 4l-6 0l0 -4" />
                                            </svg>
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

    //JENIS KAPAL
    document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById("jenis_kapal"), {
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
        }));
    });

    //BENDERA
    document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById("bendera"), {
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
        }));
    });
</script>

@endsection