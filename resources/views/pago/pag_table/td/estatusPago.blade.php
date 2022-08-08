<td>
  @switch($pago->estat_pag)
    @case(config('app.aprobado'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $pago->estat_pag }}</span>
      @break
    @case(config('app.rechazado'))
      <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $pago->estat_pag }}</span>
      @break
    @case(config('app.pendiente'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pago->estat_pag }}</span>
      @break
    @default
      {{ $pago->estat_pag }}
  @endswitch

  @include('pago.pag_table.td.alertas')
</td>