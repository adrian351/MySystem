@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de proveedores'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('proveedor.pro_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'proveedor.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('proveedor.index'), 'opciones_buscador' => config('opcionesSelect.select_proveedor_index')])
    {!! Form::close() !!}
    @include('proveedor.pro_table')
    @include('global.paginador.paginador', ['paginar' => $proveedores])
  </div>
</div>
@endsection