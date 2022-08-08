<td width="1rem" title="Editar: {{ $manual->id }}">
    @can('manual.edit')
      <a href="{{ route('manual.edit', Crypt::encrypt($manual->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  </td>
  <td width="1rem" title="Eliminar: {{ $manual->id }}">
    @can('manual.destroy')
      <form method="post" action="{{ route('manual.destroy', Crypt::encrypt($manual->id)) }}" id="manualDestroy{{ $manual->id }}">
        @method('DELETE')@csrf
        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$manual->id", 'onclick' => "return check('btnsub$manual->id', 'manualDestroy$manual->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $manual->id ($manual->valor) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
      </form>
    @endcan
  </td>