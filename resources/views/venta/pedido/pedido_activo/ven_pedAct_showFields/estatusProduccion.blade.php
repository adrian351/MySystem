@switch($pedido->estat_produc)
  @case(config('app.pendiente'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.asignar_lider_de_pedido'))
    @php $borde = config('app.color_m'); @endphp
    @break
  @case(config('app.en_espera_de_almacen'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.productos_completos'))
    @php $borde = config('app.color_n'); @endphp
    @break
  @case(config('app.en_produccion'))
    @php $borde = config('app.color_m'); @endphp
    @break
  @case(config('app.en_almacen_de_salida_terminado'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @default 
    @php $borde = config('app.color_null'); @endphp
@endswitch

<div class="form-group col-sm btn-sm">
  <label for="estatus_produccion">{{ __('Estatus producción') }} {{ $pedido->fech_estat_produc }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('estatus_produccion', $pedido->estat_produc, ['class' => 'form-control disable', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus producción'), 'readonly' => 'readonly']) !!}
  </div>
</div>