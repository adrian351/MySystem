@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pago').' '.$pago->cod_fact)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong> {{ $pago->cod_fact }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $pago->cod_fact }}</small>
    </div>
  </div>
  <div class="card-body">
    <label for="redes_sociales">{{ __('INFORMACIÓN DEL PAGO') }}</label>
    <div class="border border-primary rounded p-2">
      <div class="row">
        @include('pago.pag_showFields.numeroDePedido')
        @include('venta.pedido.pedido_activo.ven_pedAct_showFields.montoTotalDelPedido1')
      </div>
      <div class="row">
        @include('pago.pag_showFields.nota')
      </div>
      <div class="row">
        @include('pago.pag_showFields.codigoDeFacturacion')
        @include('pago.pag_showFields.estatusPago')
      </div>
      <div class="row">
        @include('pago.pag_showFields.formaDePago')
        @include('pago.pag_showFields.montoDePago')
      </div>
      @include('pago.pag_showFields.comentarios')
    </div>
    {!! Form::open(['route' => ['rolCliente.pago.update', Crypt::encrypt($pago->id)], 'method' => 'patch', 'id' => 'pagofPedidoUpdate', 'files' => true]) !!}
      @include('pago.fPedido.pago.pag_editFields')
      @include('pago.pag_showFields.archivos_comPago_copIdentificacion')
      <div class="row">
        <div class="form-group col-sm btn-sm" >
          <a href="{{ route('pago.fPedido.create', Crypt::encrypt($pedido->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'pagofPedidoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection