@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar inventario'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('tecnologia_de_la_informacion.inventarioEquipo.ti_inv_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'inventario.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}  
      @include('tecnologia_de_la_informacion.inventarioEquipo.ti_inv_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection