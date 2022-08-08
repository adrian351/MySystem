<td width="1rem" title="Editar: {{ $proveedor->nom_comerc }}">
  @can(['almacen.producto.proveedor.edit'])
    <a href="{{ route('almacen.producto.proveedor.edit', [Crypt::encrypt($producto->id), Crypt::encrypt($proveedor->id)]) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $proveedor->nom_comerc }}">
  @can(['almacen.producto.proveedor.destroy'])
    <form method="post" action="{{ route('almacen.producto.proveedor.destroy', [Crypt::encrypt($producto->id), Crypt::encrypt($proveedor->id)]) }}" id="almacenProductoProveedorDestroy{{ $proveedor->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$proveedor->id", 'onclick' => "return check('btnsub$proveedor->id', 'almacenProductoProveedorDestroy$proveedor->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. Se alterarán los precios del producto y a su vez los armados relacionados con este producto. ¿Estás seguro que quieres realizar esta acción para el registro: $proveedor->id ($proveedor->nom_comerc) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td> 