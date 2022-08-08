@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Crear cotización'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('cotizacion.cot_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'cotizacion.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('cotizacion.cot_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection