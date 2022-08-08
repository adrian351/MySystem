@extends('layouts.private.perfil.dashboard')
@section('contenido')
<title>@section('title', __('Confirmar contraseña'))</title>
<div class="container">
  <div class="card-body">
    <div class="callout callout-danger">
      <h5>{{ __('Por favor confirme su contraseña antes de continuar') }}</h5>
      <form method="POST" action="{{ route('password.confirm') }}" onsubmit="return checarBotonSubmit('btnsubmit')">
        @csrf
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <label for="nombre">{{ __('Contraseña') }} *</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
               <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Contraseña') }}" required autocomplete="current-password">
            </div>
            <span class="text-danger">{{ $errors->first('password') }}</span>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <button type="submit" class="btn btn-primary" id="btnsubmit"><i class="fas fa-lock-open"></i> {{ __('Confirmar Contraseña') }}</button>
            @if (Route::has('password.request'))
              <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
              </a>
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection