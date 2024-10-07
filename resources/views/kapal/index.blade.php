@extends('welcome')

@section('content')
<div class="ui main container fluid">
    <h1 class="ui header">Master Kapal</h1>
    <div class="ui divider hidden"></div>
    <div class="column">
        <a class="ui positive button add"><i class="plus icon" style="visibility: visible;"></i> Tambah</a>
        <a class="ui negative button delete"><i class="trash icon" style="visibility: visible;"></i> Hapus</a>
        <a class="ui orange button print"><i class="print icon" style="visibility: visible;"></i> Cetak</a>
    </div>
    <div class="ui divider hidden"></div>
    <div id="alert_response"></div>

    @if ($message = Session::get('success'))
    <div class="ui poitive message">
        <i class="close icon"></i>
        <div class="header">
            Data tesimpan
        </div>
        <p>{{ $message }}</p>
    </div>
    @elseif ($message = Session::get('danger'))
    <div class="ui negative message">
        <i class="close icon"></i>
        <div class="header">
            Data gagal disimpan
        </div>
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="ui compact table celled" id="example">
        <thead>
            <tr>
                <th></th>
                <th class="center aligned">
                </th>
                <th class="center aligned">Kode Kapal</th>
                <th class="center aligned">Nama Kapal</th>
                <th class="center aligned">Callsign</th>
                <th class="center aligned">Jenis Kapal</th>
                <th class="center aligned">Bendera</th>
                <th class="center aligned">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kapal as $i)
            <tr id="index_{{ $i->FLAG_IDX }}">
                <td>{{ $no++ }}</td>
                <td class="center aligned">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" value="{{ $i->FLAG_IDX }}" name="checkboxes">
                    </div>
                </td>
                <td class="kode">{{ $i->KODE_KAPAL }}</td>
                <td class="asal">{{ $i->NAMA_KAPAL }}</td>
                <td class="asal">{{ $i->CALLSIGN }}</td>
                <td class="asal">{{ $i->JENIS_KAPAL }}</td>
                <td class="asal">{{ $i->KODE_BENDERA }}/{{ $i->bendera->ASAL_NEGARA }}</td>
                <td class="center aligned">
                    <button class="ui icon orange button show" id="{{ $i->FLAG_IDX }}" onclick="showDataKapal(this.id)"><i class="eye icon" style="visibility: visible;"></i></button>
                    <a class="ui icon primary button" href="{{ route('kapal.edit', $i->FLAG_IDX) }}"><i class="edit icon" style="visibility: visible;"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- MODAL TAMBAH DATA -->
    <div class="ui modal add">
        <div class="header">Tambah Data Kapal</div>
        <div class="content">
            <form class="ui form" action="{{ route('kapal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label>Kode Kapal</label>
                        <input type="text" name="kode_kapal" placeholder="Isi kode kapal">
                    </div>
                    <div class="field">
                        <label>Nama Kapal
                        </label>
                        <input type="text" name="nama_kapal" placeholder="Isi nama kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Callsign</label>
                        <input type="text" name="callsign" placeholder="Isi callsign kapal">
                    </div>
                    <div class="field">
                        <label>Jenis Kapal</label>
                        <div class="field">
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="jenis_kapal">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih Jenis Kapal</div>
                                <div class="menu">
                                    @foreach($jenis_kapal as $i)
                                    <div class="item" name="jenis_kapal" data-value="{{ $i->JENIS_KAPAL }}">{{ $i->JENIS_KAPAL }} / {{ $i->G1 }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Bendera</label>
                        <div class="field">
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="kode_bendera">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih Bendera Kapal</div>
                                <div class="menu">
                                    @foreach($bendera as $i)
                                    <div class="item" name="kode_bendera" data-value="{{ $i->KODE_BENDERA }}">{{ $i->KODE_BENDERA}} / {{ $i->ASAL_NEGARA }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Panjang <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="panjang" placeholder="Isi panjang kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Lebar <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="lebar" placeholder="Isi lebar kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Draft <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="draft" placeholder="Isi callsign kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Tinggi <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="tinggi" placeholder="Isi tinggi kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Gross Ton <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="gross_ton" placeholder="Isi gross kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Dead Ton <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="dead_ton" placeholder="Isi dead ton kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Displacement <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="displacement" placeholder="Isi displacement kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Jenis Mesin</label>
                        </div>
                        <input type="text" name="jenis_mesin" placeholder="Isi jenis mesin kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Daya Mesin <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="daya_mesin" placeholder="Isi daya mesin kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <div class="row">
                            <label>Kecepatan Maks.</label>
                            <span class="ui red text input-desimal" id="input-desimal" style="display: none;">*angka, gunakan desimal '.'</span>
                        </div>
                        <input type="text" class="data-input" name="kecepatan_maksimal" placeholder="Isi kecepatan maksimal kapal">
                    </div>
                    <div class="field">
                        <div class="row">
                            <label>Kapasitas Kargo / ton <span class="ui red text input-desimal" style="display: none;">*angka, gunakan desimal '.'</span></label>
                        </div>
                        <input type="text" class="data-input" name="kapasitas_kargo" placeholder="Isi kapasitas kargo kapal">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Kapasitas Penumpang / orang</label>
                        <input type="number" name="kapasitas_penumpang" placeholder="Isi kapasitas penumpang">
                    </div>
                    <div class="field">
                        <label>Tahun Pembuatan Kapal</label>
                        <div class="ui calendar" id="year_calendar">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" name="tahun_pembuatan" placeholder="Pilih tahun">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Galangan Kapal</label>
                        <input type="text" name="galangan_kapal" placeholder="Isi galangan kapal">
                    </div>
                    <div class="field">
                        <label>Klasifikasi</label>
                        <input type="text" name="klasifikasi" placeholder="Isi klasifikasi kapal">
                    </div>
                </div>
        </div>
        <div class="actions">
            <a class="ui negative deny button">
                Batal
            </a>
            <button class="ui positive right labeled icon button" type="submit">
                <i class="checkmark icon"></i>
                Simpan
            </button>
        </div>
        </form>
    </div>

    <!-- MODAL SHOW DATA -->
    <div class="ui modal show">
        <div class="header">Lihat Data Kapal</div>
        <div class="content">
            <div class="ui form" id="result-show"></div>
        </div>
    </div>

    <!-- MODAL HAPUS DATA -->
    <div class="ui modal delete">
        <div class="header">
            Hapus data ini?
        </div>
        <div class="content">
            <p>Data ini tidak dapat kembali</p>
        </div>
        <div class="actions">
            <button class="ui negative button buttonHapus" type="submit">
                <i class="trash icon"></i>
                Hapus
            </button>
        </div>
    </div>

    <!-- MODAL CETAK DATA -->
    <div class="ui modal print">
        <div class="header">
            Pilih Cetak Data
        </div>
        <div class="content" style="padding-bottom: 50px;">
            <div class="ui fluid search selection dropdown">
                <input type="hidden" name="jenis_cetak">
                <i class="dropdown icon"></i>
                <div class="default text">Pilih Format Cetak Data</div>
                <div class="menu" id="pilih-cetak">
                    <div class="item tes" name="jenis_cetak" value="PDF" onclick="pilihJenisCetak(event)">PDF</div>
                    <div class="item tes" name="jenis_cetak" value="EXCEL" onclick="pilihJenisCetak(event)">Excel</div>
                </div>
            </div>
        </div>
        <div class="actions">
            <button class="ui positive button buttonPrint" type="submit">
                <i class="print icon"></i>
                Cetak
            </button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function pilihJenisCetak(event) {
        let jenis_cetak = event.target.getAttribute('value');
        return jenis_cetak;
    }

    $('.item.tes').click(function(event) {

        let tes = pilihJenisCetak(event);

    });

    let datas_id = []

    $('input[name="checkboxes"]').change(function() {
        var checked = parseInt($(this).val());

        if ($(this).is(':checked')) {
            datas_id.push(checked);
        } else {
            datas_id.splice($.inArray(checked, datas_id), 1);
        }
    });


    $('.buttonPrint').on('click', function() {
        console.log(datas_id)
    });

    function pilihDataKapal() {

        $('.ui.button.buttonHapus').click(function() {

            let token = "{{ csrf_token() }}"

            datas_id.forEach(function(element) {
                let el = document.getElementById(`index_${element}`);
                if (el) {
                    el.remove();
                }
            });

            $.ajax({
                url: "{{ route('kapal.destroy') }}",
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    checked_data: datas_id,
                    _token: token
                },
                success: function(response) {
                    $('#alert_response').html(`
                        <div class="ui positive message">
                            <i class="close icon"></i>
                            <div class="header">
                                Data berhasil dihapus
                            </div>
                            <p>${response.message}</p>
                        </div>`);
                },

                error: function(xhr, status, error) {
                    $('#alert_response').html(`
                    <div class="ui negative message">
                        <i class="close icon"></i>
                        <div class="header">
                            Data gagal dihapus
                        </div>
                        <p>${response.error}</p>
                    </div>`);
                }
            });
        });

        // $('.ui.button.buttonPrint').click(function() {

        //     let token = "{{ csrf_token() }}"

        //     let selectedPrintType = $('.item.tes.selected').attr('value');

        //     $.ajax({
        //         url: "{{ route('kapal.print') }}",
        //         type: "GET",
        //         data: {
        //             jenis_cetak: selectedPrintType,
        //             checked_data: datas_id,
        //             _token: token,
        //         },
        //         success: function(response) {
        //             $('#alert_response').html(`
        //             <div class="ui positive message">
        //                 <i class="close icon"></i>
        //                 <div class="header">
        //                     Data kapal berhasil dicetak
        //                 </div>
        //                 <p>${message}</p>
        //             </div>`);

        //         },
        //         error: function(xhr, status, error) {

        //             $('#alert_response').html(`
        //             <div class="ui negative message">
        //                 <i class="close icon"></i>
        //                 <div class="header">
        //                     Data kapal gagal dicetak
        //                 </div>
        //                 <p>${error}</p>
        //             </div>`);
        //         }
        //     })
        // })
    }
</script>
@endsection