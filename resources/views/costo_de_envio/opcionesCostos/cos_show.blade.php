<h4><label for="redes_sociales">{{ __('INFORMACIÓN') }}</label></h4>
<div class="border border-primary rounded p-3">
  <div class="row">
    @include('cotizacion.cot_showFields.serie')
    @include('cotizacion.cot_showFields.validez')
  </div>
  <div class="row">
    @include('cotizacion.cot_showFields.correoCliente')
  </div>
  <div class="row">
    @include('cotizacion.armado_cotizacion.cot_arm_show.descripcion')
    @include('cotizacion.armado_cotizacion.cot_arm_show.cantidad')
  </div>
</div>