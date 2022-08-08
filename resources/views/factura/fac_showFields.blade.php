@include('factura.fac_showFields.created')
<div class="row">
  @include('factura.fac_showFields.numPedido')
  @include('factura.fac_showFields.fechaDeFacturado')
</div>
@include('factura.fac_showFields.documentosFactura')
@include('factura.fac_showFields.informacionDelPago')
<div class="row">
  @include('factura.fac_showFields.estatusFactura')
  @include('factura.fac_showFields.cliente')
</div>
@include('factura.fac_showFields.comentariosCliente')
@include('factura.fac_showFields.comentariosAdministrador')
@include('factura.fac_showFields.datosFiscales')
@include('factura.fac_showFields.datosFactura')