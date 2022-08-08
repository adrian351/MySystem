@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar producto'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('almacen.producto.alm_pro_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'almacen.producto.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      @include('almacen.producto.alm_pro_createFields')
      <label for="datos_del_proveedor">{{ __('DATOS DEL PROVEEDOR') }}</label>
      <div class="border border-primary rounded p-2">
        @include('almacen.producto.proveedor_producto.alm_pro_proPro_createFields')
      </div>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('almacen.producto.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection