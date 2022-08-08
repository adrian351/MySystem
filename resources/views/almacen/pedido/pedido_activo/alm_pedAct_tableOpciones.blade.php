<td width="1rem" title="Editar: {{ $pedido->num_pedido }}">
  @canany(['almacen.pedidoActivo.edit', 'almacen.pedidoActivo.armado.edit'])
    <a href="{{ route('almacen.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcanany
</td>
<td width="1rem" title="Generar PDF: {{ $pedido->num_pedido }}">
  @can('almacen.pedidoActivo.index')
    <a href="{{ route('almacen.pedidoActivo.generarOrdenDeProduccion', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-file-pdf"></i></a>
  @endcan
</td>