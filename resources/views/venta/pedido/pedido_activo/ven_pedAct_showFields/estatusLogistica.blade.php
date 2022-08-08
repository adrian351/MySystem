@switch($pedido->estat_log)
  @case(config('app.pendiente'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.en_espera_de_produccion'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.en_almacen_de_salida'))
    @php $borde = config('app.color_h'); @endphp
    @break
  @case(config('app.en_ruta'))
    @php $borde = config('app.color_g'); @endphp
    @break
  @case(config('app.entregado'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @case(config('app.sin_entrega_por_falta_de_informacion'))
    @php $borde = config('app.color_f'); @endphp
    @break
  @case(config('app.intento_de_entrega_fallido'))
    @php $borde = config('app.color_f'); @endphp
    @break
  @default
    @php $borde = config('app.color_null'); @endphp
@endswitch

<div class="form-group col-sm btn-sm">
  <label for="estatus_logistica">{{ __('Estatus logística') }} {{ $pedido->fech_estat_log }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('estatus_logistica', $pedido->estat_log, ['class' => 'form-control disable', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus logística'), 'readonly' => 'readonly']) !!}
  </div>
</div>