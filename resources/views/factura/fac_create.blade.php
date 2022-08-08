@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Solicitar factura'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('factura.fac_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'factura.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('factura.fac_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection