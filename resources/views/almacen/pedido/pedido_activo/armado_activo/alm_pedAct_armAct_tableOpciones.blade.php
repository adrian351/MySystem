<td width="1rem" title="Editar: {{ $armado->id }}">
  @if($armado->estat == config('app.en_espera_de_compra') OR $armado->estat == config('app.en_revision_de_productos'))
    @can('almacen.pedidoActivo.armado.edit')
      <a href="{{ route('almacen.pedidoActivo.armado.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  @endif
</td>