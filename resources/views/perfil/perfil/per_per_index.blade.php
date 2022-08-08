@extends('layouts.private.perfil.dashboard')
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('titulo')
<title>@section('title', __('Perfil'))</title>
<div class="col-sm-12">
  <div class="shadow-lg p-2 mb-3 bg-body rounded bg-info ">
    <center>
      <h4 class="m-0 "> {{ __('Perfil') }}</h4>
    </center>
  </div>
</div>
@endsection
@section('contenido')
<div class="row">
  <div class="col-md-3">
    @include('perfil.perfil.per_per_show')
  </div>
<div class="col-md-9">
  <div class="card">
    <div class="card-header p-2">
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link {{ Request::is('perfil/editar') ? 'active' : '' }}" href="{{ route('perfil.edit') }}"><i class="fas fa-edit"></i> {{ __('Editar') }}</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('perfil/personalizarSistema/editar') ? 'active' : '' }}" href="{{ route('perfil.personalizar.edit') }}"><i class="fas fa-tachometer-alt"></i> {{ __('Personalizar') }}</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('perfil/actividad') ? 'active' : '' }}" href="{{ route('perfil.actividad.index') }}"><i class="fas fa-folder"></i> {{ __('Actividad') }}</a></li>
      </ul>
    </div>
    <div class="card-body">
      @yield('contenidoPerfil')
    </div>
  </div>
</div>
@endsection