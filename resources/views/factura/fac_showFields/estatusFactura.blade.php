@switch($factura->est_fact)
  @case(config('app.no_solicitada'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.pendiente'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.error_del_cliente'))
    @php $borde = config('app.color_c'); @endphp
    @break
  @case(config('app.facturado'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @case(config('app.facturado_por_fuera'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @case(config('app.cancelado'))
    @php $borde = config('app.color_f'); @endphp
    @break
  @case(config('app.facturado_eliminado'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @default
    @php $borde = config('app.color_null'); @endphp
@endswitch 

<div class="form-group col-sm btn-sm">
  <label for="estatus_factura">{{ __('Estatus factura') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('estatus_factura', $factura->est_fact, ['class' => 'form-control disable', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus factura'), 'readonly' => 'readonly']) !!}
  </div>
</div>