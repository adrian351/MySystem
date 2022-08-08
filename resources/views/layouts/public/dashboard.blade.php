<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ Sistema::datos()->sistemaFindOrFail()->log_blan_rut . Sistema::datos()->sistemaFindOrFail()->log_blan }}">
  <title>@yield('title', 'Inicio')</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/silver/pace-theme-minimal.css') }}">
  @laravelPWA
  @yield('recapcha')
  @yield('css')
  @yield('css1')
  @yield('css2')
</head>
<body style="font-family: Segoe UI;">
  <div id="dashboard">
    @yield('contenido')
  </div>
  @include('layouts.public.footer')
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="{{ asset('plugins/pace-progress/pace.min.js') }}"></script>
  <script src="{{ asset('js/myfunction.js') }}"></script>
  @yield('js')
  @yield('js1')
  @yield('js2')
</body>
</html>