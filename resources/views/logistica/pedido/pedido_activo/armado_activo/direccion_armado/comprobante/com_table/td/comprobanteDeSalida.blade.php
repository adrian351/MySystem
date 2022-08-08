<td>
  @if($comprobante->comp_de_sal_nom != null)
  <a href="{{ $comprobante->comp_de_sal_rut.$comprobante->comp_de_sal_nom }}" download>{{ $comprobante->comp_de_sal_nom }}</a>
  @else
    <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ __('Falta cargar comprobante de salida') }}</span>
  @endif
</td>