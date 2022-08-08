<td width="1rem" title="Editar: {{ $pedido->num_pedido }}">
  @canany(['logistica.pedidoActivo.edit', 'logistica.pedidoActivo.armado.edit'])
    <a href="{{ route('logistica.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcanany
</td>