@include('cotizacion.cot_showFields.created')
<div class="row">
  @include('cotizacion.cot_showFields.serie')
  @include('cotizacion.cot_showFields.validez')
  @include('cotizacion.cot_showFields.numPedidoGenerado')
</div>
<div class="row">
  @include('cotizacion.cot_showFields.correoCliente')
  @include('cotizacion.cot_showFields.estatus')
</div>
<div class="row">
  @include('cotizacion.cot_showFields.descripcionCotizacion')
  @if($cotizacion->coment != null)
  <div class="form-group col-sm btn-sm">
    <label for="comentarios">{{ __('Comentarios') }} ({{ __('Estos aparecerán al generar la cotización') }})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width "></i></span>
      </div>
      {!! Form::textarea('comentarios', $cotizacion->coment, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Comentarios'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
  @endif
</div>
@if($cotizacion->coment_vent != null)
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="comentarios_ventas">{{ __('Comentarios ventas') }} ({{ _('Estos se guardaran en el pedido') }})</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::textarea('comentarios_ventas', $cotizacion->coment_vent, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Comentarios ventas'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
@endif
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('cotizacion.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>