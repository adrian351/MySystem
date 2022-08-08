<td width="1rem" title="Eliminar: {{ $archivo->nom_visual }}">
  <form method="post" action="{{ route('venta.pedidoActivo.archivo.destroy', Crypt::encrypt($archivo->id)) }}" id="ventaPedidoActivoArchivoDestroy{{ $archivo->id }}">
    @method('DELETE')@csrf
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$archivo->id", 'onclick' => "return check('btnsub$archivo->id', 'ventaPedidoActivoArchivoDestroy$archivo->id', '¡Alerta!', 'Eliminaras permanentemente este registro. ¿Estás seguro que quieres realizar esta acción para el registro: $archivo->id ($archivo->nom_visual) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
  </form>
</td>