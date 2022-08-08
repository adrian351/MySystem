<td width="1rem">
  @if($cotizacion->valid >= date("Y-m-d")) 
    <span class="badge" style="background:{{ config('app.color_g') }}">{{ $cotizacion->valid }}</span>
  @else
    <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $cotizacion->valid }}</span>
  @endif
</td>