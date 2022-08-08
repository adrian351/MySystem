<div class="row">
  <div class="col-md">
    <div class="pad">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.created')
      <div class="row">
        @include('venta.pedido.pedido_activo.ven_pedAct_showFields.cliente')
        @include('venta.pedido.pedido_activo.ven_pedAct_showFields.fechaDeEntrega')
      </div>
    </div>
  </div>
  @if (sizeof($pedido->unificar) != 0)
    @include('venta.pedido.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado', ['alto' => 'height: 10em;'])
  @endif
  
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.sePuedeEntregarAntes')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.cuantosDiasAntes')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.cotizacionGenerada')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.stock')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.bodega')
</div>

<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusAlmacen')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusProduccion')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusLogistica')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.liderDePedidoAlmacen')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.liderDePedidoProduccion')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatus')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.tipo')
</div>

<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentariosCliente')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentariosVenta')
</div>

<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentariosAlmacen')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentariosProduccion')
</div>
<div class="row">
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentariosLogistica')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.comentarioOReclamo')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('venta.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection