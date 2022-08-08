<td width="1rem" title="Eliminar: {{ $precio->year }}">
  <form method="post" action="{{ route('almacen.producto.precio.destroy', [Crypt::encrypt($precio->id), Crypt::encrypt($precio->id)]) }}" id="almacenProductoPrecioDestroy{{ $precio->id }}">
    @method('DELETE')@csrf
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$precio->id", 'onclick' => "return check('btnsub$precio->id', 'almacenProductoPrecioDestroy$precio->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $precio->year ($precio->prec) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
  </form>
</td> 