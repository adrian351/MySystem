@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido activo logística').' '.$pedido->num_pedido)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusLogisticaHeader')
    </div>
    <h5>
      <strong>{{ __('Editar pedido activo logística') }}: </strong>
      @can('logistica.pedidoActivo.show')
        <a href="{{ route('logistica.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>
<div class="row">
  @can('logistica.pedidoActivo.edit')
    <div class="col-md">
      <div class="pad">
          <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
            <div class="card-body">
              {!! Form::open(['route' => ['logistica.pedidoActivo.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'logisticapedidoActivoUpdate']) !!}
                @include('logistica.pedido.pedido_activo.pedAct_editFields')
                <div class="row">
                  <div class="form-group col-sm btn-sm" >
                    <a href="{{ route('logistica.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
                  </div>
                  <div class="form-group col-sm btn-sm">
                    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'logisticapedidoActivoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar pedido') }}</button>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
      </div>
    </div>
  @endcan
  @if (sizeof($pedido->unificar) != 0)
      
    @can('logistica.pedidoActivo.edit')
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado', ['alto' => 'height: 17.6em;'])
    @endcan
  @endif
</div>
@include('logistica.pedido.pedido_activo.armado_activo.armAct_index')
@endsection