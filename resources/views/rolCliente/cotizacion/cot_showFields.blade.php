<div class="row">
  @include('cotizacion.cot_showFields.serie')
  @include('cotizacion.cot_showFields.validez')
  @include('cotizacion.cot_showFields.numPedidoGenerado')
</div>
<div class="row">
  @include('cotizacion.cot_showFields.estatus')
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('rolCliente.cotizacion.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>