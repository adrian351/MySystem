@extends('layouts.private.escritorio.dashboard')
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('contenido')
<title>@section('title', __('Registrar queja y sugerencia'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('queja_y_sugerencia.qsu_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'qys.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
    @include('queja_y_sugerencia.qsu_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection