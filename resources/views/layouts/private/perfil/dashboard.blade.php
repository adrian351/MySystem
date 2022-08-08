<!DOCTYPE html>
<html lang="{{ Auth::user()->lang }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ Sistema::datos()->sistemaFindOrFail()->log_blan_rut . Sistema::datos()->sistemaFindOrFail()->log_blan }}">
  <title>@yield('title', __('Perfil'))</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/silver/pace-theme-minimal.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  @laravelPWA
  @yield('recapcha')
  @yield('css')
  @yield('css1')
  @yield('css2')
  <!-- Complementos para el plugin toastr -->
  @toastr_css
  <!-- Fin (Complementos para el plugin toastr) -->
</head>
<body class="hold-transition layout-top-nav text-sm" style="font-family: Segoe UI;">
<div class="wrapper">
  <div id="dashboard">
    <nav class="main-header navbar navbar-expand-md {{ Auth::user()->col_barr_de_naveg }}">
      <div class="container-fluid">
        @include('layouts.private.perfil.menuHeader')
      </div>
    </nav>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            @yield('titulo')
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid pb-1">
          @yield('contenido')
        </div>
      </div>
    </div>
  </div>
  @include('layouts.private.footer')
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/pace-progress/pace.min.js') }}"></script>
<script src="{{ asset('js/myfunction.js') }}"></script>
@yield('js')
@yield('js1')
@yield('js2')
<!-- Complementos para el plugin toastr -->
@jquery
@toastr_js
@toastr_render
<!-- Fin (Complementos para el plugin toastr) -->
</body>
</html>