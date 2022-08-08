<td>
  @if($armado->cant == $armado->cant_direc_carg)
    <span class="badge" style="background:{{ config('app.color_d') }}">{{ config('app.direcciones_detalladas') }}</span>
  @else
    <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ config('app.falta_detallar_direccion') }}</span>
  @endif
</td>