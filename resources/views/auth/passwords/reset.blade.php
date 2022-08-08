@extends('auth.inicio')
@section('header')
<title>@section('title', __('Establecer nueva contraseña'))</title>
@endsection
@section('contenido-inicio')
<form method="POST" action="{{ route('password.update') }}" class="login100-form" onsubmit="return checarBotonSubmit('btnsubmit')">
  @csrf
  @include('layouts.public.logo')
  <input type="hidden" name="token" value="{{ $token }}">
  <div class="shadow-lg p-3">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="email">{{ __('Correo electrónico') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text btn-sm"><i class="fas fa-envelope"></i></span>
          </div>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('Correo electrónico') }}" required autocomplete="email" autofocus>
        </div>
        <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="email">{{ __('Contraseña') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text btn-sm"><i class="fas fa-lock"></i></span>
          </div>
          <input id="txtpassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Contraseña') }}" required autocomplete="new-password">
          <span class="input-group-append">
            <button id="show_password1" class="btn btn-info btn-flat btn-sm" type="button" onclick="mostrarPassword('txtpassword', 'show_password1', 'icon1')"><span class="fa fa-eye-slash icon1"></span></button>
          </span>
        </div>
        <span class="text-danger">{{ $errors->first('password') }}</span>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="password_confirmation">{{ __('Confirmar contraseña') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text btn-sm"><i class="fas fa-lock"></i></span>
          </div>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirmar contraseña') }}" required autocomplete="new-password">
          <span class="input-group-append">
            <button id="show_password2" class="btn btn-info btn-flat btn-sm" type="button" onclick="mostrarPassword('password-confirm', 'show_password2', 'icon2')"><span class="fa fa-eye-slash icon2"></span></button>
          </span>
        </div>
      </div>
    </div>           
    <div class="row justify-content-center">
      <button type="submit" class="btn btn-primary w-75 p-3" id="btnsubmit">
        <i class="fas fa-lock-open"></i> {{ __('Restablecer contraseña') }}
      </button>
    </div>
  </div>
</form>
@endsection