<td width="1rem">
  @if($show == true)
    @canany([$canany])
      <a href="{{ route($ruta, Crypt::encrypt($factura->id)) }}" title="Detalles: {{ $factura->id }}" {{ $target }}>{{ $factura->id }}</a>
    @else
      {{ $factura->id }}
    @endcanany
  @else
    {{ $factura->id }}
  @endif
</td>