<td>
  @can('cliente.show')
    <a href="{{ route('cliente.show', Crypt::encrypt($factura->usuario->id)) }}" target="_blank"> {{ $factura->usuario->nom }} ({{ $factura->usuario->email_registro }})</a>
  @else
    {{ $factura->usuario->nom }} ({{ $factura->usuario->email_registro }})
  @endcan
</td>