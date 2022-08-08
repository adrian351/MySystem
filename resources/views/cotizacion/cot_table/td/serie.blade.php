<td>
  @if($show == true)
    @canany($canany)
      <a href="{{ route($ruta, Crypt::encrypt($cotizacion->id)) }}" title="Detalles: {{ $cotizacion->serie }}" {{ $target }}>{{ $cotizacion->serie }}</a>
    @else
      {{ $cotizacion->serie }}
    @endcanany
  @else
    {{ $cotizacion->serie }}
  @endif
</td>