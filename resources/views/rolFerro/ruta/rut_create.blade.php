@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar ruta'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rolFerro.ruta.rut_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'rolFerro.ruta.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('rolFerro.ruta.rut_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection