<td>
  @can('cliente.show')
    <a href="{{ route('cliente.show', Crypt::encrypt($pedido->usuario->id)) }}" target="_blank"> {{ $pedido->usuario->nom }} ({{ $pedido->usuario->email_registro }})</a>
  @else
    {{ $pedido->usuario->nom }} ({{ $pedido->usuario->email_registro }})
  @endcan
</td>