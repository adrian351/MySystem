<td width="1rem">
  @if($show == true)
    @canany([$canany])
      <a href="{{ route($ruta, Crypt::encrypt($comprobante->id)) }}" title="Detalles: {{ $comprobante->id }}" {{ $target }}>{{ $comprobante->id }}</a>
    @else
      {{ $comprobante->id }}
    @endcanany
  @else
    {{ $comprobante->id }}
  @endif
</td>