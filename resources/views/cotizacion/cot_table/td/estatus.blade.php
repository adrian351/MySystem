<td>
  @switch($cotizacion->estat)
    @case(config('app.abierta'))
      <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $cotizacion->estat }}</span>
      @break
    @case(config('app.aprobada'))
      <span class="badge" style="background:{{ config('app.color_d') }}">{{ $cotizacion->estat }}</span>
      @break
    @case(config('app.cancelada'))
      <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $cotizacion->estat }}</span>
      @break
    @default
      {{ $cotizacion->estat }}
  @endswitch
</td>