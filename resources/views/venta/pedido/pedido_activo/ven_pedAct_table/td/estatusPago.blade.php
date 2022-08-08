<td>
  @switch($pedido->estat_pag)
    @case(config('app.pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pago_pendiente_de_aprobar'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pago_rechazado'))
      <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pagado'))
      <span class="badge" style="background:{{ config('app.color_d') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pagado_eliminados'))
      <span class="badge" style="background:{{ config('app.color_d') }};">{{ $pedido->estat_pag }}</span>
      @break
    @case(config('app.pagoseliminados'))
      <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_pag }}</span>
      @break
    @default
      {{ $pedido->estat_pag }}
  @endswitch
</td>