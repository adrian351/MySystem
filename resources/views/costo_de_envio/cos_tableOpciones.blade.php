<td width="1rem" title="Editar: {{ $costo_de_envio->id }}">
  @can('costoDeEnvio.edit')
    <a href="{{ route('costoDeEnvio.edit', Crypt::encrypt($costo_de_envio->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $costo_de_envio->id }}">
  @can('costoDeEnvio.destroy')
    <form method="post" action="{{ route('costoDeEnvio.destroy', Crypt::encrypt($costo_de_envio->id)) }}" id="costoDeEnvioDestroy{{ $costo_de_envio->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnDes$costo_de_envio->id", 'onclick' => "return check('btnDes$costo_de_envio->id', 'costoDeEnvioDestroy$costo_de_envio->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $costo_de_envio->id ($costo_de_envio->met_de_entreg) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>