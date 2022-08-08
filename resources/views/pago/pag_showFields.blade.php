@include('pago.pag_showFields.created')
<div class="row">
  @include('pago.pag_showFields.cliente')
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.montoTotalDelPedido1')
</div>
<div class="row">
  @include('pago.pag_showFields.numeroDePedido')
  @include('factura.fac_showFields.estatusFactura', ['factura' => $pago])
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
@include('pago.pag_showFields.comentariosVentas')
@include('pago.pag_showFields.archivos_comPago_copIdentificacion')