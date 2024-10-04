<!DOCTYPE html>
<html>

<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Site Properties -->
  <title>APP NGP</title>

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/fomantic-ui/dist/semantic.css') }} ">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/fomantic-ui/dist/semantic.min.css') }} ">
  <link rel="stylesheet" type="text/css" class="ui" media="screen,print" href="{{ asset('assets/fomantic-ui/dist/semantic.min.css?v=2.9.3') }}">
  <link rel="stylesheet/less" type="text/css" href="{{ asset('assets/fomantic-ui/src/definitions/collections/form.less') }} " />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.semanticui.css')}}">

  <style type="text/css">
    body {
      background-color: #fff;
    }

    .appgps {
      margin-left: 4em;
      margin-right: 4em;
      padding-bottom: 4em;
    }

    .main.container {
      margin-top: 6em;
    }

    .ui.menu .item img.logo {
      margin-right: 1.5em;
    }
  </style>
</head>

<body>
  <!-- BEGIN MENU =============================================================================================== -->
  <div class="ui fixed inverted menu">
    <a href="#" class="header item"><img class="logo" src="{{ asset('img/nogo.png') }}">APP NGP OPR</a>
    <div class="ui simple dropdown item">Master<i class="dropdown icon"></i>
      <div class="menu">
        <div class="divider"></div>
        <div class="header">Master Data</div>
        <a class="item" href="{{ route('kapal.index') }}">Kapal</a>
        <a class="item" href="">Jenis Kapal</a>
        <a class="item" href="{{ route('bendera.index') }}">Bendera</a>
        <a class="item" href="">Ownership</a>
        <a class="item" href="">Contact Person</a>
      </div>
    </div>
    <div class="right menu">
      <a class="item" href="{{ route('logout') }}"><i class="sign out icon" style="visibility: visible;"></i>Keluar</a>
    </div>
  </div>
  <!-- END MENU ================================================================================================= -->

  <!-- BEGIN CONATINER ========================================================================================== -->
  <div class="appgps">
    @yield('content')
  </div>
  <!-- END CONATINER ============================================================================================ -->

  <!-- BEGIN FOOTER ============================================================================================= -->
</body>

<script src="{{ asset('javascript/library/jquery.min.js') }}"></script>
<script src="{{ asset('assets/fomantic-ui/dist/semantic.js') }} "></script>
<script src="{{ asset('assets/fomantic-ui/dist/semantic.min.js?v=2.9.3') }} "></script>
<script src="{{ asset('javascript/library/dataTables.js') }}"></script>
<script src="{{ asset('assets/fomantic-ui/dist/semantic.min.js') }}"></script>
<script src="{{ asset('javascript/library/dataTables.semanticui.js') }}"></script>
<script>
  //BUTTON ADD DATA
  $('.ui.button.add').click(function() {
    $('.ui.modal.add').modal('show');
  });

  $('.ui.button.closeAdd').click(function() {
    $('.ui.modal.add').modal('hide');
  });

  //BUTTON EDIT DATA
  $('.ui.button.edit').click(function() {
    $('.ui.modal.edit').modal('show');
  });

  //BUTTON DELETE DATA
  $('.ui.button.delete').click(function() {
    $('.ui.modal.delete').modal('show');
  });

  //BUTTON SHOW DATA
  $('.ui.button.show').click(function() {
    $('.ui.modal.show').modal('show');
  });

  //BUTTON CETAK DATA
  $('.ui.button.cetak').click(function() {
    $('.ui.modal.cetak').modal('show');
  });

  // SEARCH DROPDOWN
  $('.selection.dropdown')
    .dropdown();

  //CHECKBOX
  $('.ui.checkbox')
    .checkbox();

  //CLOSE ALERT
  $('.message .close')
    .on('click', function() {
      $(this)
        .closest('.message')
        .transition('fade');
    });

  //YEAR CALENDAR
  $('#year_calendar')
    .calendar({
      type: 'year'
    });

  //CHECKED ALL
  $('.ui.checkbox.semua').change(function() {
    if (this.checked) {
      $("input[type='checkbox']").prop('checked', this.checked);
    } else {
      $("input[type='checkbox']").prop('checked', false);
    }
  });

  // CHECK INPUT NUMBER DOT ONLY
  document.addEventListener('DOMContentLoaded', function() {
    let decimalRegex = /^\d*(\.\d*)?$/;

    document.querySelectorAll('.data-input').forEach(input => {
      input.addEventListener('input', function() {
        let inputValue = this.value;
        let errorMessage = this.parentElement.querySelector('.input-desimal');

        if (!decimalRegex.test(inputValue)) {
          errorMessage.style.display = 'inline';
        } else {
          errorMessage.style.display = 'none';
        }
      });
    });
  });

  //DATATABLES UI
  new DataTable('#example', {
    layout: {
      bottomEnd: {
        paging: {
          firstLast: false
        }
      }
    }
  });

  //KAPAL SHOW DATA DETAIL
  function showDataKapal(id) {

    let token = "{{ csrf_token() }}";

    $.ajax({
      url: "{{ route('kapal.show') }}",
      type: "GET",
      data: {
        id: id,
        _token: token
      },
      success: function(response) {
        $('#result-show').html(`
        <div class="ui form">
            <div class="two fields">
                <div class="field">
                    <label>Kode Kapal
                        <p>${response.KODE_KAPAL}</p>
                    </label>
                </div>
                <div class="field">
                    <label>Nama Kapal
                        <p>${response.NAMA_KAPAL}</p>
                    </label>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Callsign
                        <p>${response.CALLSIGN}</p>
                    </label>
                </div>
                <div class="field">
                    <label>Jenis Kapal
                        <p>${response.JENIS_KAPAL}</p>
                    </label>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Bendera
                        <p>${response.KODE_BENDERA}</p>
                    </label>
                </div>
                <div class="field">
                    <label>Panjang Kapal
                        <p>${response.PANJANG}/m2</p>
                    </label>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Lebar
                        <p>${response.LEBAR}/m2</p>
                    </label>
                </div>
                <div class="field">
                    <label>Draft
                        <p>${response.DRAFT}/m2</p>
                    </label>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Tinggi
                        <p>${response.TINGGI}/m2</p>
                    </label>
                </div>
                <div class="field">
                    <label>Gross Ton
                        <p>${response.GROSS_TON} ton</p>
                    </label>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Displacement
                        <p>${response.DISPLACEMENT} ton</p>
                    </label>
                </div>
                <div class="field">
                    <label>Draft
                        <p>${response.DRAFT}/m2</p>
                    </label>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Jenis Mesin
                        <p>${response.JENIS_MESIN} ton</p>
                    </label>
                </div>
                <div class="field">
                    <label>Daya Mesin
                        <p>${response.DAYA_MESIN}/m2</p>
                    </label>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Kecepatan Maksimal
                        <p>${response.KECEPATAN_MAX} ton</p>
                    </label>
                </div>
                <div class="field">
                    <label>Kapasitas Kargo
                        <p>${response.KAPASITAS_KARGO} ton</p>
                    </label>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Kapasitas Penumpang
                        <p>${response.KAPASITAS_PENUMPANG} orang</p>
                    </label>
                </div>
                <div class="field">
                    <label>Tahun Pembuatan
                        <p>${response.TAHUN_PEMBUATAN}</p>
                    </label>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Galangan Kapal
                        <p>${response.GALANGAN_KAPAL}</p>
                    </label>
                </div>
                <div class="field">
                    <label>Klasifikasi
                        <p>${response.KLASIFIKASI}</p>
                    </label>
                </div>
            </div>
        </div>`)
      },
      error: function(xhr, status, error) {
        console.error("Gagal mengambil data: ", error);
      }
    })
  }
</script>

@yield('script')

</html>

<!-- END FOOTER ================================================================================================= -->