<td>
  @can('cliente.show')
    <a href="{{ route('cliente.show', Crypt::encrypt($pago->usuario->id)) }}" target="_blank"> {{ $pago->usuario->nom }} ({{ $pago->usuario->email_registro }})</a>
  @else
    {{ $pago->usuario->nom }} ({{ $pago->usuario->email_registro }})
  @endcan
</td>