<td width="1rem" title="Editar: {{ $armado->sku }}">
  @canany(['armado.clon.edit', 'armado.clon.producto.create', 'armado.clon.producto.destroy', 'armado.clon.producto.editCantidad'])
    <a href="{{ route('armado.clon.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcanany
</td>
<td width="1rem" title="Eliminar: {{ $armado->sku }}">
  @can('armado.clon.destroy')
    <form method="post" action="{{ route('armado.clon.destroy', Crypt::encrypt($armado->id)) }}" id="armadoClonDestroy{{ $armado->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$armado->id", 'onclick' => "return check('btnsub$armado->id', 'armadoClonDestroy$armado->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información (Imagenes y productos). ¿Estás seguro que quieres realizar esta acción para el registro: $armado->id ($armado->sku) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>