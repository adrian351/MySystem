<td>
  @switch($direccion->estat)
    @case(config('app.pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $direccion->estat }}</span>
      @break
    @case(config('app.en_almacen_de_salida'))
      <span class="badge" style="background:{{ config('app.color_h') }}">{{ $direccion->estat }}</span>
      @break
    @case(config('app.en_ruta'))
      <span class="badge" style="background:{{ config('app.color_g') }}">{{ $direccion->estat }}</span>
      @break
    @case(config('app.entregado'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $direccion->estat }}</span>
      @break
    @case(config('app.sin_entrega_por_falta_de_informacion'))
      <span class="badge" style="background:{{ config('app.color_f') }}">{{ $direccion->estat }}</span>
      @break
    @case(config('app.intento_de_entrega_fallido'))
      <span class="badge" style="background:{{ config('app.color_f') }}">{{ $direccion->estat }}</span>
      @break
    @default
      {{ $direccion->estat }}
  @endswitch
</td>