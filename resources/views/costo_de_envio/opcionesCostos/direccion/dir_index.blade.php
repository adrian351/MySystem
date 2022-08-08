@extends('layouts.public.dashboard')
@section('header')
<title>@section('title', __('Direcciones'))</title>
@endsection
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('contenido')
<div class="container">
  <div class="container-fluid">
    <div class="card-body">
      @include('costo_de_envio.opcionesCostos.direccion.dir_show')<br><br>
      <h1>{{ ('Otros métodos de entrega') }}</h1>
      @include('costo_de_envio.opcionesCostos.direccion.dir_table')
    </div>  
  </div>
</div>
@endsection