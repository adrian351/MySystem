<td>
  @can('cliente.show')
  <a href="{{ route('cliente.show', Crypt::encrypt($cotizacion->cliente->id)) }}" target="_blank"> {{ $cotizacion->cliente->nom }} ({{ $cotizacion->cliente->email_registro }})</a>
  @else
    {{ $cotizacion->cliente->nom }} ({{ $cotizacion->cliente->email_registro }})
  @endcan
</td>