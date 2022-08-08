@include('costo_de_envio.cos_showFields.created')
<div class="row">
  @include('costo_de_envio.cos_showFields.foraneoLocal')
  @include('costo_de_envio.cos_showFields.metodoDeEntrega')
  @include('costo_de_envio.cos_showFields.metodoDeEntregaEspesifico')
</div>
<div class="row">
  @include('costo_de_envio.cos_showFields.cantidad')
  @include('costo_de_envio.cos_showFields.transporte')
</div>
<div class="row">
  @include('costo_de_envio.cos_showFields.estado')
  @include('costo_de_envio.cos_showFields.municipio')
</div>
<div class="row">
  @include('costo_de_envio.cos_showFields.tipoDeEnvio')
  @include('costo_de_envio.cos_showFields.tamano')
</div>
<div class="row">
  @include('costo_de_envio.cos_showFields.costo_caja')
  @include('costo_de_envio.cos_showFields.cuentaConSeguro')
</div>
<div class="row">
  @include('costo_de_envio.cos_showFields.tiempoDeEntrega')
  @include('costo_de_envio.cos_showFields.costoPorEnvio')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('costoDeEnvio.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection