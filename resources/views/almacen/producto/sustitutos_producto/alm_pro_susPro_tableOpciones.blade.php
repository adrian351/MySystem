<td width="1rem" title="Eliminar: {{ $producto->sku }}">
  @can('almacen.producto.sustituto.destroy')
    {{-- $producto->pivot->producto_id = id del producto y $producto->id = id del sustituto --}}
    <form method="post" action="{{ route('almacen.producto.sustituto.destroy', [Crypt::encrypt($producto->pivot->producto_id), Crypt::encrypt($producto->id)]) }}" id="almacenProductoSustitutoDestroy{{ $producto->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$producto->id", 'onclick' => "return check('btnsub$producto->id', 'almacenProductoSustitutoDestroy$producto->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $producto->id ($producto->sku) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>