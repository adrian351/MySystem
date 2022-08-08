<td width="1rem" title="Editar: {{ $pedido->num_pedido }}">
  @canany(['produccion.pedidoActivo.edit', 'produccion.pedidoActivo.armado.edit'])
    <a href="{{ route('produccion.pedidoActivo.edit', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcanany
</td>
<td width="1rem" title="Generar PDF: {{ $pedido->num_pedido }}">
  @can('produccion.pedidoActivo.index')
    <a href="{{ route('produccion.pedidoActivo.generarOrdenDeProduccion', Crypt::encrypt($pedido->id)) }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-file-pdf"></i></a>
  @endcan
</td>