@switch($pedido->estat_alm)
  @case(config('app.pendiente'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.asignar_persona_que_recibe'))
    @php $borde = config('app.color_m'); @endphp
    @break
  @case(config('app.en_espera_de_ventas'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.en_espera_de_compra'))
    @php $borde = config('app.color_l'); @endphp
    @break
  @case(config('app.en_revision_de_productos'))
    @php $borde = config('app.color_j'); @endphp
    @break
  @case(config('app.productos_completos_terminado'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @default
    @php $borde = config('app.color_null'); @endphp
@endswitch

<div class="form-group col-sm btn-sm">
  <label for="estatus_almacen">{{ __('Estatus almacén') }} {{ $pedido->fech_estat_alm }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('estatus_almacen', $pedido->estat_alm, ['class' => 'form-control disable', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus almacén'), 'readonly' => 'readonly']) !!}
  </div>
</div>