<td width="1rem" title="Eliminar: {{ $producto->sku }}">
  @canany(['armado.producto.destroy', 'armado.clon.producto.destroy'])
    <form method="post" action="{{ route('armado.producto.destroy', [Crypt::encrypt($armado->id), Crypt::encrypt($producto->id)]) }}" id="armadoProductoDestroy{{ $producto->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$producto->id", 'onclick' => "return check('btnsub$producto->id', 'armadoProductoDestroy$producto->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $producto->id ($producto->sku) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcanany
</td>