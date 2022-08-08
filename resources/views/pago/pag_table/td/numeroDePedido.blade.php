<td>
  @can('venta.pedido.show')
    <a href="{{ route('venta.pedidoActivo.show', Crypt::encrypt($pago->pedido->id)) }}" target="_blank">{{ $pago->pedido->num_pedido  }}</a>
  @else
    {{ $pago->pedido->num_pedido  }}
  @endcan
</td>