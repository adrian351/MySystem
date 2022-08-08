<label for="redes_sociales">{{ __('INFORMACÍON DEL PAGO') }}</label>
<div class="border border-primary rounded p-2">
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
  @include('pago.pag_showFields.comentariosVentas')
  @include('pago.pag_showFields.archivos_comPago_copIdentificacion')
</div>