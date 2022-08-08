<td>
  @switch($pedido->estat_log)
    @case(config('app.pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_log }}</span>
      @break
    @case(config('app.asignar_lider_de_pedido'))
      <span class="badge" style="background:{{ config('app.color_m') }}">{{ $pedido->estat_log }}</span>
      @break
    @case(config('app.en_espera_de_produccion'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_log }}</span>
      @break
    @case(config('app.en_almacen_de_salida'))
      <span class="badge" style="background:{{ config('app.color_h') }}">{{ $pedido->estat_log }}</span>
      @break
    @case(config('app.en_ruta'))
      <span class="badge" style="background:{{ config('app.color_g') }}">{{ $pedido->estat_log }}</span>
      @break
    @case(config('app.entregado'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $pedido->estat_log }}</span>
      @break
    @case(config('app.sin_entrega_por_falta_de_informacion'))
      <span class="badge" style="background:{{ config('app.color_f') }}">{{ $pedido->estat_log }}</span>
      @break
    @case(config('app.intento_de_entrega_fallido'))
      <span class="badge" style="background:{{ config('app.color_f') }}">{{ $pedido->estat_log }}</span>
      @break
    @default
      {{ $pedido->estat_log }}
  @endswitch
</td>