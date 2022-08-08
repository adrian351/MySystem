<td width="1rem" title="Registrar pago: {{ $pedido->num_pedido }}">
  @canany(['pago.fPedido.index', 'pago.fPedido.create', 'pago.fPedido.show', 'pago.fPedido.edit', 'venta.pedidoActivo.show', 'venta.pedidoActivo.pago.create', 'venta.pedidoActivo.pago.show', 'venta.pedidoActivo.pago.edit'])
    <a href="{{ route('pago.fPedido.create', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-plus-circle"></i></a>
  @endcanany
</td>