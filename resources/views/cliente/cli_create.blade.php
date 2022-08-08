@extends('layouts.private.escritorio.dashboard')
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('contenido')
<title>@section('title', __('Registrar cliente'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('cliente.cli_menu')
    </ul>
  </div>
  <div class="card-body">
    @include('layouts.private.generarPassword')
    {!! Form::open(['route' => 'cliente.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      @include('usuario.usu_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection