@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Lista de productos'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('almacen.producto.alm_pro_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'almacen.producto.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('almacen.producto.index'), 'opciones_buscador' => config('opcionesSelect.select_producto_index')])
    {!! Form::close() !!}
    @include('almacen.producto.alm_pro_table')
    @include('global.paginador.paginador', ['paginar' => $productos])
    <div class="row">
      <div class="form-group col-sm-2">
        <p style="background:#ff000060; padding:15px; font-weight:bold; border:2px solid #ff000060; margin-top:40px; border-radius:10px;" data-toggle="tooltip" data-placement="bottom" title="El producto no ha sido validado" class="text-center p-1 ">{{ __('No validado') }}</p>
      </div>
      <div class="form-group col-sm-2">
        <p style="background:#ffe600d5; padding:15px; font-weight:bold; border:2px solid #f0efe560; margin-top:40px; border-radius:10px;" data-toggle="tooltip" data-placement="bottom" title="Se rebaso la cantidad mínima de stock" class="text-center p-1 ">{{ __('Stcok mínimo') }}</p>
      </div>
    </div>
  </div>
</div>
@endsection