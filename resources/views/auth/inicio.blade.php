@extends('layouts.public.dashboard')
@section('contenido')
<div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100">
      @yield('contenido-inicio')
      @if(Request::route()->getName() == 'login')
        <div class="login100-more" style="background-image: url('{{ Sistema::datos()->sistemaFindOrFail()->carrus_login_rut . Sistema::datos()->sistemaFindOrFail()->carrus_login }}');"></div>
      @elseif(Request::route()->getName() == 'password.request')
        <div class="login100-more" style="background-image: url('{{ Sistema::datos()->sistemaFindOrFail()->carrus_reque_rut . Sistema::datos()->sistemaFindOrFail()->carrus_reque }}');"></div>
      @elseif(Request::route()->getName() == 'password.reset')
        <div class="login100-more" style="background-image: url('{{ Sistema::datos()->sistemaFindOrFail()->carrus_rese_rut . Sistema::datos()->sistemaFindOrFail()->carrus_rese }}');"></div>
      @endif
    </div>
  </div>
</div>
@endsection