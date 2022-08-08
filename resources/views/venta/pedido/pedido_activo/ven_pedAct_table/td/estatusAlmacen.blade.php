<td> 
  @switch($pedido->estat_alm)
    @case(config('app.pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_alm }}</span>
      @break
    @case(config('app.asignar_persona_que_recibe'))
      <span class="badge" style="background:{{ config('app.color_m') }};">{{ $pedido->estat_alm }}</span>
      @break
    @case(config('app.en_espera_de_ventas'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_alm }}</span>
      @break
    @case(config('app.en_espera_de_compra'))
      <span class="badge" style="background:{{ config('app.color_l') }}">{{ $pedido->estat_alm }}</span>
      @break
    @case(config('app.en_revision_de_productos'))
      <span class="badge" style="background:{{ config('app.color_j') }}">{{ $pedido->estat_alm }}</span>
      @break
    @case(config('app.productos_completos_terminado'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $pedido->estat_alm }}</span>
      @break
    @default
      {{ $pedido->estat_alm }}
  @endswitch
</td>