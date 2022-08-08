<td>
  @switch($factura->est_fact)
    @case(config('app.no_solicitada'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $factura->est_fact }}</span>
      @break
    @case(config('app.pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $factura->est_fact }}</span>
      @break
    @case(config('app.error_del_cliente'))
      <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $factura->est_fact }}</span>
      @break
    @case(config('app.facturado'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $factura->est_fact }}</span>
      @break
    @case(config('app.facturado_por_fuera'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $factura->est_fact }}</span>
      @break
    @case(config('app.cancelado'))
      <span class="badge" style="background:{{ config('app.color_f') }}">{{ $factura->est_fact }}</span>
      @break
    @case(config('app.facturado_eliminado'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $factura->est_fact }}</span>
      @break
    @default
      {{ $factura->est_fact }}
  @endswitch 
</td>