@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar proveedor al producto').' '.$producto->produc)</title>
<div class="card c{{ config('app.color_card_primario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Registrar proveedor al producto') }}:</strong> {{ $producto->produc }}
    </h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['almacen.producto.proveedor.store', Crypt::encrypt($producto->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('almacen.producto.proveedor_producto.alm_pro_proPro_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('almacen.producto.edit', Crypt::encrypt($producto->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Continuar con el producto') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection