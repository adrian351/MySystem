<!DOCTYPE html>
<html lang="{{ Auth::user()->lang }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ Sistema::datos()->sistemaFindOrFail()->log_blan_rut . Sistema::datos()->sistemaFindOrFail()->log_blan }}">
  <title>@yield('title', __('Inicio'))</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
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
  @yield('css3')
  <!-- Complementos para el plugin toastr -->
  @toastr_css
  <!-- Fin (Complementos para el plugin toastr) -->
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm {{ Auth::user()->sidebar }}" style="font-family: Segoe UI;">
<div class="wrapper">
  <div id="dashboard">
    <nav class="main-header navbar navbar-expand {{ Auth::user()->col_barr_de_naveg }}">
      @include('layouts.private.escritorio.menuHeader')
    </nav>        
    <aside class="main-sidebar elevation-4 {{ Auth::user()->col_barr_lat_oscu_o_clar }}">
      @include('layouts.private.escritorio.barraLateralIzquierda')
    </aside>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            @yield('titulo')
          </div>
        </div>
      </div>
      <section class="content">
        <div class="container-fluid pb-1">
          @yield('contenido')
        </div>
      </section>
    </div>
    @if(Request::route()->getName() != 'home')
      <aside class="control-sidebar {{ Auth::user()->col_barr_lat_der_oscu_o_clar }}">
        @include('layouts.private.escritorio.barraLateralDerecha')
      </aside>
    @endif
  </div>
  @include('layouts.private.includes') <!-- Modales que se utilizaran en los diferentes módulos -->
  @include('layouts.private.footer')
</div>
<script src="{{ asset('js/app.js') }}"></script>
@yield('vuejs')
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
@yield('js3')
@yield('js4')
@yield('js5')
@yield('js6')
<!-- Complementos para el plugin toastr -->
@jquery
@toastr_js
@toastr_render
<!-- Fin (Complementos para el plugin toastr) -->
</body>
</html>