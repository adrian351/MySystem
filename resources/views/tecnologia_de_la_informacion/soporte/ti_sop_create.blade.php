<!DOCTYPE html>
<html lang="es"> 
  <head>
    <title>{{ __('Solicitar soporte') }}</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/silver/pace-theme-minimal.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    @toastr_css
  </head>
  <body id="crearsoporte">
    <div class="container">
      <div  class="container-fluid">
        <div class="card-body">
          <h1>{{ __('Solicitar Soporte') }}</h1>
          {!! Form::open(['route' => 'soporte.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
            @include('tecnologia_de_la_informacion.soporte.ti_sop_createFields')
          {!! Form::close() !!}
        </div>  
      </div>
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
  </body>
</html>