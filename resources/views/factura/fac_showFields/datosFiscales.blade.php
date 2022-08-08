<label for="redes_sociales">{{ __('DATOS FISCALES') }}</label>
<div class="border border-primary rounded p-2">
  @include('rolCliente.datoFiscal.dfi_showFields', ['dato_fiscal' => $factura])
</div>