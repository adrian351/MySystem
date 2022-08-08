<td width="1rem" title="Editar: {{ $serie->id }}">
  @can('sistema.serie.edit')
    <a href="{{ route('sistema.serie.edit', Crypt::encrypt($serie->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $serie->id }}">
  @can('sistema.serie.destroy')
    <form method="post" action="{{ route('sistema.serie.destroy', Crypt::encrypt($serie->id)) }}" id="sistemaSerieDestroy{{ $serie->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$serie->id", 'onclick' => "return check('btnsub$serie->id', 'sistemaSerieDestroy$serie->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $serie->id ($serie->vista) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>