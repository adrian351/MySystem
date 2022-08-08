@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pago').' '.$pago->cod_fact)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('pago.fPedido.show')
        <a href="{{ route('pago.fPedido.show', Crypt::encrypt($pago->id)) }}" class="text-white">{{ $pago->cod_fact }}</a>
      @else
        {{ $pago->cod_fact }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $pago->cod_fact }}</small>
    </div>
  </div>
  <div class="card-body">
    <div id="pago">
      <div class="card">
          <h5 class="mb-0 p-1">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsePago" aria-expanded="false" aria-controls="collapsePago">
              <i class="fas fa-arrow-right"></i>&nbsp;&nbsp;&nbsp;<b>{{ __('INFORMACIÓN DEL PAGO') }}</b>
            </button>
          </h5>
        <div id="collapsePago" class="collapse" aria-labelledby="headingThree" data-parent="#pago">
          <div class="card-body">
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
              <div class="row">
                @include('pago.pag_showFields.usuarioQueAutorizo')
                @include('pago.pag_showFields.folio')
              </div>
              @include('pago.pag_showFields.comentarios')
            </div>
          </div>
        </div>
      </div>
    </div>

    {!! Form::open(['route' => ['pago.fPedido.update', Crypt::encrypt($pago->id)], 'method' => 'patch', 'id' => 'pagofPedidoUpdate', 'files' => true]) !!}
      @include('pago.fPedido.pago.pag_editFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="comentarios_ventas">{{ __('Comentarios ventas') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text-width"></i></span>
            </div>
            {!! Form::textarea('comentarios_ventas', $pago->coment_pag_vent, ['class' => 'form-control' . ($errors->has('comentarios_ventas') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentarios ventas'), 'rows' => 4, 'cols' => 4]) !!}
          </div>
          <span class="text-danger">{{ $errors->first('comentarios_ventas') }}</span>
        </div>
      </div>
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