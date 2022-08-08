<td>
  @switch($armado->estat)
    @case(config('app.pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $armado->estat }}</span>
      @break
    @case(config('app.en_espera_de_compra'))
      <span class="badge" style="background:{{ config('app.color_l') }}">{{ $armado->estat }}</span>
      @break
    @case(config('app.en_revision_de_productos'))
      <span class="badge" style="background:{{ config('app.color_j') }}">{{ $armado->estat }}</span>
      @break
    @case(config('app.productos_completos'))
      <span class="badge" style="background:{{ config('app.color_n') }}">{{ $armado->estat }}</span>
      @break
    @case(config('app.en_produccion'))
      <span class="badge" style="background:{{ config('app.color_m') }}">{{ $armado->estat }}</span>
      @break
    @case(config('app.en_almacen_de_salida'))
      <span class="badge" style="background:{{ config('app.color_h') }}">{{ $armado->estat }}</span>
      @break
    @case(config('app.en_ruta'))
      <span class="badge" style="background:{{ config('app.color_g') }}">{{ $armado->estat }}</span>
      @break
    @case(config('app.entregado'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $armado->estat }}</span>
      @break
    @case(config('app.sin_entrega_por_falta_de_informacion'))
      <span class="badge" style="background:{{ config('app.color_f') }}">{{ $armado->estat }}</span>
      @break
    @case(config('app.intento_de_entrega_fallido'))
      <span class="badge" style="background:{{ config('app.color_f') }}">{{ $armado->estat }}</span>
      @break
      @case(config('app.cancelado'))
      <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $armado->estat }}</span>
      @break
    @default
      {{ $armado->estat }}
  @endswitch
</td>