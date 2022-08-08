<td width="1rem" title="Editar: {{ $armado->cod }}">
  @can('venta.pedidoActivo.armado.edit')
    <a href="{{ route('venta.pedidoActivo.armado.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>