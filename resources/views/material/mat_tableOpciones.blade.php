<td width="1rem" title="Editar: {{ $material->sku }}">
  @can('material.edit')
    <a href="{{ route('material.edit', Crypt::encrypt($material->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $material->sku }}">
  @can('material.destroy')
    <form method="post" action="{{ route('material.destroy', Crypt::encrypt($material->id)) }}" id="materialDestroy{{ $material->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$material->id", 'onclick' => "return check('btnsub$material->id', 'materialDestroy$material->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $material->sku ($material->produc_lin) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>