<td width="1rem" title="Editar: {{ $plantilla->nom }}">
  @can('sistema.plantilla.edit')
    <a href="{{ route('sistema.plantilla.edit', Crypt::encrypt($plantilla->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $plantilla->nom }}">
  @can('sistema.plantilla.destroy')
    <form method="post" action="{{ route('sistema.plantilla.destroy', Crypt::encrypt($plantilla->id)) }}" id="sistemaPlantillaDestroy{{ $plantilla->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$plantilla->id", 'onclick' => "return check('btnsub$plantilla->id', 'sistemaPlantillaDestroy$plantilla->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $plantilla->id ($plantilla->nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>