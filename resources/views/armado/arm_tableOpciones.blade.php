<td width="1rem" title="Editar: {{ $armado->sku }}">
  @canany(['armado.edit', 'armado.producto.create', 'armado.producto.destroy', 'armado.producto.editCantidad'])
    <a href="{{ route('armado.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcanany
</td>
<td width="1rem" title="Clonar: {{ $armado->sku }}">
  @can('armado.clon.create')
  <form method="post" action="{{ route('armado.clon.store', Crypt::encrypt($armado->id)) }}" id="armadoClonStore{{ $armado->id }}">
    @method('GET')@csrf
    {!! Form::button('<i class="far fa-clone"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-sm', 'id' => "btnsubArmadoClonStore$armado->id", 'onclick' => "return check('btnsubArmadoClonStore$armado->id', 'armadoClonStore$armado->id', '¡Alerta!', '¿Estás seguro quieres clonar el registro, $armado->id ($armado->sku) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
  </form>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $armado->sku }}">
  @can('armado.destroy')
    <form method="post" action="{{ route('armado.destroy', Crypt::encrypt($armado->id)) }}" id="armadoDestroy{{ $armado->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$armado->id", 'onclick' => "return check('btnsub$armado->id', 'armadoDestroy$armado->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información (Imagenes y productos). ¿Estás seguro que quieres realizar esta acción para el registro: $armado->id ($armado->sku) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>