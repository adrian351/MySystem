<td width="1rem" title="Agregar sustituto: {{ $producto->id }}">
  @can('almacen.pedidoActivo.armado.edit')
    <a href="{{ route('almacen.pedidoActivo.armado.sistituto.create', Crypt::encrypt($producto->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-plus-circle"></i></a>
  @endcan
</td>