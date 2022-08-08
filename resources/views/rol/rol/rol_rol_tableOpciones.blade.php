<td width="1rem" title="Editar: {{ $rol->nom }}">
  @can('rol.edit')
    <a href="{{ route('rol.edit', Crypt::encrypt($rol->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $rol->nom }}">
  @can('rol.destroy')
    <form method="post" action="{{ route('rol.destroy', Crypt::encrypt($rol->id)) }}" id="rolDestroy{{ $rol->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$rol->id", 'onclick' => "return check('btnsub$rol->id', 'rolDestroy$rol->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $rol->id ($rol->nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>