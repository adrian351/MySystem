<td>
  @switch($armado->estat)
    @case(config('app.pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ config('app.pendiente') }}</span>
      @break
    @case(config('app.en_espera_de_compra'))
      <span class="badge" style="background:{{ config('app.color_m') }}">{{  config('app.en_produccion') }}</span>
      @break
    @case(config('app.en_revision_de_productos'))
      <span class="badge" style="background:{{ config('app.color_m') }}">{{  config('app.en_produccion') }}</span>
      @break
    @case(config('app.productos_completos'))
      <span class="badge" style="background:{{ config('app.color_m') }}">{{  config('app.en_produccion') }}</span>
      @break
    @case(config('app.en_produccion'))
      <span class="badge" style="background:{{ config('app.color_m') }}">{{  config('app.en_produccion') }}</span>
      @break
    @case(config('app.en_almacen_de_salida'))
      <span class="badge" style="background:{{ config('app.color_h') }}">{{ config('app.en_almacen_de_salida') }}</span>
      @break
    @case(config('app.en_ruta'))
      <span class="badge" style="background:{{ config('app.color_g') }}">{{ config('app.en_ruta') }}</span>
      @break
    @case(config('app.entregado'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ config('app.entregado') }}</span>
      @break
    @case(config('app.sin_entrega_por_falta_de_informacion'))
      <span class="badge" style="background:{{ config('app.color_f') }}">{{ config('app.sin_entrega_por_falta_de_informacion') }}</span>
      @break
    @case(config('app.intento_de_entrega_fallido'))
      <span class="badge" style="background:{{ config('app.color_f') }}">{{ config('app.intento_de_entrega_fallido') }}</span>
      @break
    @default
      {{ config('app.pendiente') }}
  @endswitch
</td>