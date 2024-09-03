<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Login</title>
    <!-- CSS files -->
    <link href="{{ asset('./dist/css/tabler.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('./dist/css/tabler-flags.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('./dist/css/tabler-payments.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('./dist/css/tabler-vendors.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{ asset('./dist/css/demo.min.css?1692870487')}}" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="card card-md">
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Masuk</h2>
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
                      <!-- <div>
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                      </div> -->
                      <div>{{ $message }}</div>
                  </div>
                  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
              </div>
              @endif
            <form action="{{ route('login') }}" method="POST">
            @csrf
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off">
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Password
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" name="password" id="password" class="form-control"  placeholder="Your password"  autocomplete="off">
                  <span class="input-group-text">
                    <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                    </a>
                  </span>
                </div>
              </div>
              <div class="mb-2">
                <label class="form-check">
                  <input type="checkbox" class="form-check-input" onclick="myPassword()"/>
                  <span class="form-check-label">Lihat Password</span>
                </label>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Masuk</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=" {{ asset('./dist/libs/apexcharts/dist/apexcharts.min.js?1692870487')}}" defer></script>
    <script src=" {{ asset('./dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487')}}" defer></script>
    <script src=" {{ asset('./dist/libs/jsvectormap/dist/maps/world.js?1692870487')}}" defer></script>
    <script src=" {{ asset('./dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487')}}" defer></script>
    <!-- Tabler Core -->
    <script src=" {{ asset('./dist/js/tabler.min.js?1692870487')}}" defer></script>
    <script src=" {{ asset('./dist/js/demo.min.js?1692870487')}}" defer></script>
	<script src=" {{ asset('./dist/sweetalert2/sweetalert2.min.js') }}"></script>
	<script src=" {{ asset('./dist/libs/litepicker/dist/litepicker.js?1692870487')}}" defer></script>
  </body>
  <script>
    // Password toggle
      function myPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
  </script>
</html>