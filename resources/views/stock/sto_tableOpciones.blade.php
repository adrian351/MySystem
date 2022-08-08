<td width="1rem" title="Editar: {{ $stock->nom }}">
  @can('stock.edit')
    <a href="{{ route('stock.edit', Crypt::encrypt($stock->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $stock->nom }}">
  @can('stock.destroy')
    <form method="post" action="{{ route('stock.destroy', Crypt::encrypt($stock->id)) }}" id="stockDestroy{{ $stock->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$stock->id", 'onclick' => "return check('btnsub$stock->id', 'stockDestroy$stock->id', '¡Alerta!', 'Eliminaras permanentemente este registro. ¿Estás seguro que quieres realizar esta acción para el registro: $stock->id ($stock->cant) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>