@switch($armado->estat)
  @case(config('app.pendiente')) <!-- ESTATUS VENTAS -->
    @php $borde = config('app.color_a'); @endphp
    @break
  <!-- ESTATUS AlMACÉN -->
  @case(config('app.en_espera_de_compra'))
    @php $borde = config('app.color_l'); @endphp
    @break
  @case(config('app.en_revision_de_productos'))
    @php $borde = config('app.color_j'); @endphp
    @break
  <!-- ESTATUS PRODUCCIÓN -->
  @case(config('app.productos_completos'))
    @php $borde = config('app.color_n'); @endphp
    @break
  @case(config('app.en_produccion'))
    @php $borde = config('app.color_m'); @endphp
    @break
  <!-- ESTATUS ESTATUS LOGÍSTICA -->
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
  <!-- ESTATUS GLOBAL -->
  @case(config('app.cancelado'))
    @php $borde = config('app.color_c'); @endphp
    @break
  @default
    @php $borde = config('app.color_null'); @endphp
@endswitch

<div class="form-group col-sm btn-sm">
  <label for="estatus">{{ __('Estatus') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('estatus', $armado->estat, ['class' => 'form-control disabled', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus'), 'readonly' => 'readonly']) !!}
  </div>
</div>