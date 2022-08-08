<td width="1rem" title="Editar: {{ $direccion->id }}">
  <a href="{{ route('rolCliente.direccion.edit', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
</td>
<td width="1rem" title="Eliminar: {{ $direccion->id }}">
  <form method="post" action="{{ route('rolCliente.direccion.destroy', Crypt::encrypt($direccion->id)) }}" id="rolClienteDireccionDestroy{{ $direccion->id }}">
    @method('DELETE')@csrf
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$direccion->id", 'onclick' => "return check('btnsub$direccion->id', 'rolClienteDireccionDestroy$direccion->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $direccion->id ($direccion->ciudad) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
  </form>
</td>