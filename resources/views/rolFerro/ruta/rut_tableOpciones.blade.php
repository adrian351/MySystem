<td width="1rem" title="Editar: {{ $ruta->nom }}">
    <a href="{{ route('rolFerro.ruta.edit', Crypt::encrypt($ruta->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
</td>
<td width="1rem" title="Eliminar: {{ $ruta->nom }}">
    <form method="post" action="{{ route('rolFerro.ruta.destroy', Crypt::encrypt($ruta->id)) }}" id="rolFerroRutaDestroy{{ $ruta->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$ruta->id", 'onclick' => "return check('btnsub$ruta->id', 'rolFerroRutaDestroy$ruta->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $ruta->id ($ruta->nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
</td>