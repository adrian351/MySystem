@extends('auth.inicio')
@section('header')
<title>@section('title', __('Restablecer contraseña'))</title>
@endsection
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('contenido-inicio')
<form method="POST" action="{{ route('password.email') }}" class="login100-form" onsubmit="return checarBotonSubmit('btnsubmit')">
  @csrf
  @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('status') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  @include('layouts.public.logo')
  <div class="shadow-lg p-3">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="email">{{ __('Correo electrónico') }}</label><a href="{{ route('login') }}" class="float-right">{{ __('Regresar y acceder') }}</a>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text btn-sm"><i class="fas fa-envelope"></i></span>
          </div>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Correo electrónico') }}" required autocomplete="email" autofocus>
        </div>
        <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>
    </div>
    <div class="row justify-content-center">
      <button type="submit" class="btn btn-primary w-75 p-3" id="btnsubmit">
        <i class="fas fa-share"></i> {{ __('Enviar enlace para restablecer contraseña') }}
      </button>
    </div>
  </div>
</form>
@endsection