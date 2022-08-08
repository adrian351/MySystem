@include('armado.arm_showFields.imagen')
@include('cotizacion.armado_cotizacion.cot_arm_show.created')
@include('armado.arm_showFields.medidas')
<div class="row">
  @include('armado.arm_showFields.tipo')
  @include('cotizacion.armado_cotizacion.cot_arm_show.descripcion')
  
</div>
<div class="row">
  @include('cotizacion.armado_cotizacion.cot_arm_show.cantidad')
  @include('cotizacion.armado_cotizacion.cot_arm_show.precio_unitario')
  @include('armado.arm_showFields.precioDeCompra')
  
</div>
<div class="row">
  @include('cotizacion.armado_cotizacion.cot_arm_show.es_de_regalo')
  @include('cotizacion.armado_cotizacion.cot_arm_show.es_de_stock')
</div>
@include('cotizacion.armado_cotizacion.cot_arm_show.tipoDeDescuento')
<div class="row">
  @include('cotizacion.armado_cotizacion.cot_arm_show.costo_de_envio')
  @include('armado.arm_showFields.descuentoEspecial')
</div>
<div class="row">
  @include('cotizacion.armado_cotizacion.cot_arm_show.subtotal')
  @include('cotizacion.armado_cotizacion.cot_arm_show.iva')
  @include('cotizacion.armado_cotizacion.cot_arm_show.total')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('cotizacion.show', Crypt::encrypt($armado->cotizacion_id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@include('cotizacion.armado_cotizacion.getTipoDeEnvio')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection