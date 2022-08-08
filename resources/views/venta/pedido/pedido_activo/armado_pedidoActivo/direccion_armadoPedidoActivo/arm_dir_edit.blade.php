@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar dirección').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar dirección') }}:</strong>
      @can('venta.pedidoActivo.armado.direccion.show')
        <a href="{{ route('venta.pedidoActivo.armado.direccion.show', Crypt::encrypt($direccion->id)) }}" class="text-white">{{ $direccion->est }} ({{ Sistema::dosDecimales($direccion->cant) }})</a>,
      @else
        {{ $direccion->est }},
      @endcan
     <strong>{{ __('del armado') }}:</strong> {{ $direccion->armado->cod }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
</div>
@if($direccion->armado->estat != config('app.en_produccion') AND $direccion->armado->estat != config('app.en_almacen_de_salida') AND $direccion->armado->estat != config('app.en_ruta') AND $direccion->armado->estat != config('app.sin_entrega_por_falta_de_informacion') AND $direccion->armado->estat != config('app.intento_de_entrega_fallido'))
  <div class="card">
    <div class="card-body">
      {!! Form::open(['route' => ['venta.pedidoActivo.armado.direccion.updateTarjeta', Crypt::encrypt($direccion->id)], 'method' => 'patch', 'id' => 'ventaPedidoActivoArmadoDirecionUpdateTarjeta', 'files' => true]) !!}
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_editInformacionExtra')
        <div class="row">
          {{--  regresar al pedido  --}}
          <div class="form-group col-sm btn-sm" >
            <center><a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($direccion->armado->pedido_id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
          </div>
          <div class="form-group col-sm btn-sm">
            <center><button type="submit" id="btnsubmit" class="btn btn-info w-50 p-2" onclick="return check('btnsubmit', 'ventaPedidoActivoArmadoDirecionUpdateTarjeta', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar tarjeta') }}</button></center>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @else
  <center>
    <div class="alert alert-danger col-sm-6 p-1" role="alert" >
        {{ __('Esta dirección ya no se puede editar') }}
        <a href="{{ route('venta.pedidoActivo.edit', Crypt::encrypt($direccion->armado->pedido_id)) }}" class="btn alert-link">{{ __(' Continuar con el pedido') }}</a>
    </div>
  </center>
@endif
<div class="card">
  <div class="card-body">
    {!! Form::open(['route' => ['venta.pedidoActivo.armado.direccion.update', Crypt::encrypt($direccion->id)], 'method' => 'patch', 'id' => 'ventaPedidoActivoArmadoDirecionUpdate']) !!}
      @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection