<td> 
  @switch($pedido->estat_produc)
    @case(config('app.pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_produc }}</span>
      @break
    @case(config('app.asignar_lider_de_pedido'))
      <span class="badge" style="background:{{ config('app.color_m') }};">{{ $pedido->estat_produc }}</span>
      @break
    @case(config('app.en_espera_de_almacen'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_produc }}</span>
      @break
    @case(config('app.productos_completos'))
    <span class="badge" style="background:{{ config('app.color_i') }}">{{ $pedido->estat_produc }}</span>
      @break
    @case(config('app.en_produccion'))
      <span class="badge" style="background:{{ config('app.color_m') }}">{{ $pedido->estat_produc }}</span>
      @break
    @case(config('app.en_almacen_de_salida_terminado'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $pedido->estat_produc }}</span>
      @break
      @default 
      {{ $pedido->estat_produc }}
  @endswitch
</td>