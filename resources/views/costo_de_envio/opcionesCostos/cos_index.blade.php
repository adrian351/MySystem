@extends('layouts.public.dashboard')
@section('header')
<title>@section('title', __('Costos de envío'))</title>
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
      @include('costo_de_envio.opcionesCostos.cos_show')<br><br>
      <h1>{{ ('Costos definidos por ventas') }}</h1>
      @include('costo_de_envio.opcionesCostos.cos_table')
    </div>  
  </div>
</div>
@endsection