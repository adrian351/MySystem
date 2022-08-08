<td width="1rem" title="Editar: {{ $catalogo->id }}">
  @can('sistema.catalogo.edit')
    <a href="{{ route('sistema.catalogo.edit', Crypt::encrypt($catalogo->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $catalogo->id }}">
  @can('sistema.catalogo.destroy')
    <form method="post" action="{{ route('sistema.catalogo.destroy', Crypt::encrypt($catalogo->id)) }}" id="sistemaCatalogoDestroy{{ $catalogo->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$catalogo->id", 'onclick' => "return check('btnsub$catalogo->id', 'sistemaCatalogoDestroy$catalogo->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $catalogo->id ($catalogo->vista) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>