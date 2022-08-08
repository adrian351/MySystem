@extends('auth.inicio')
@section('header')
<title>@section('title', __('Acceder'))</title>
@endsection
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('contenido-inicio')
<form method="POST" action="{{ route('login') }}" class="login100-form" onsubmit="return checarBotonSubmit('btnsubmit')">
  @csrf
  @include('layouts.public.logo')
  <div class="card-body shadow-lg" id="login">
    <div class="row">
      <span class="title_header text-center col-sm">{{ __('Inicia sesión') }}</span>
    </div>
    
    <div class="row">
      <div class="form-group col-sm">
        <label for="email">{{ __('Correo electrónico') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="i input-group-text btn-sm">
              <i class="fas fa-envelope"></i>
            </span>
          </div>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Correo electrónico') }}" required autocomplete="email" autofocus>
        </div>
        <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-sm">
        <label for="email">{{ __('Contraseña') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="i input-group-text btn-sm"><i class="fas fa-lock"></i></span>
          </div>
          <input id="txtpassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Contraseña') }}" required autocomplete="current-password">
          <span class="i input-group-append">
            <button id="show_password" class="btn btn-sm" type="button" onclick="mostrarPassword('txtpassword', 'show_password', 'icon')"><span class="fa fa-eye-slash icon"></span></button>
          </span>
        </div>
        <span class="text-danger">{{ $errors->first('password') }}</span>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-sm">
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">
          {{ __('Recuérdame') }}
        </label>
      </div>
       <div class="form-group col-sm text-right">
          @if (Route::has('password.request'))
            <a class="link" href="{{ route('password.request') }}">
              {{ __('¿Olvidaste tu contraseña?') }}
            </a>
          @endif
       </div>
    </div>
    <div class="row justify-content-center">
      <button type="submit" class="btn_acceder btn w-50 p-2 " id="btnsubmit">
        {{--  <i class="fas fa-sign-in-alt"></i>   --}}
        {{ __('Acceder') }}
      </button>
    </div>
    <hr>
    @include('layouts.redesSociales')
  </div>
</form>
@endsection

@section('css')
<style>
  .btn_acceder{
    display: flex;
    align-items: center;
    justify-content: center;
    list-style: none;
    text-align: center;
    font-size: 15px;
    color: black;
    padding: 5px 0;
    margin-right: 5px;
    border-radius: 20px;
    background:rgb(207, 214, 250);
    box-shadow: inset 4px 4px 6px -1px rgba(0, 0, 0, 0.2),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgb(171, 193, 241),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.01);
  
  }
  #login{
    -webkit-border-radius: 13px;
    border-radius: 13px;
    webkit-box-shadow: 7px 7px 14px #a6c5e4, -7px -7px 14px #c6ebff;
    box-shadow: 7px 7px 14px #a6c5e4, -7px -7px 14px #c6ebff;
  }

  #email{
    display: flex;
    align-items: center;
    justify-content: center;
    list-style: none;
    text-align: center;
    font-size: 15px;
    color: black;
    padding: 5px 0;
    margin-right: 5px;
    //border-radius: 10px;
    background:rgb(232, 235, 233);
    box-shadow: inset 4px 4px 6px -1px rgba(0, 0, 0, 0.2),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgb(255, 255, 255),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.01);
  }

  #txtpassword{
    display: flex;
    align-items: center;
    justify-content: center;
    list-style: none;
    text-align: center;
    font-size: 15px;
    color: black;
    padding: 5px 0;
    margin-right: 5px;
    //border-radius: 5px;
    background:rgb(232, 235, 233);
    box-shadow: inset 4px 4px 6px -1px rgba(0, 0, 0, 0.2),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgb(255, 255, 255),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.01);
  }

  .i{
    color: rgb(7, 7, 7);

    box-shadow: inset 4px 4px 6px -1px rgba(0,0,0,0.2),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgba(255,255,255,1),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.01);
  }

  .r{
    //justify-content: center;
    //list-style: none;
    text-align: center;
    color: black;
    border-radius: 100px;
    background:rgb(232, 235, 233);
    box-shadow: inset 4px 4px 6px -1px rgba(0, 0, 0, 0.2),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgb(255, 255, 255),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    //border: 1px solid rgba(0,0,0,0.01);
  }

  .title_header{
    font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 1.5em;
    margin-bottom: 0.5em;
    color:black;
  }

</style>
@endsection