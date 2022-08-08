<td width="1rem" title="Editar: {{ $proveedor->nom_comerc }}">
  @canany(['proveedor.edit', 'proveedor.editValidado', 'proveedor.contacto.index', 'proveedor.contacto.create', 'proveedor.contacto.edit', 'proveedor.contacto.destroy'])
    <a href="{{ route('proveedor.edit', Crypt::encrypt($proveedor->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcanany
</td>
<td width="1rem" title="Eliminar: {{ $proveedor->nom_comerc }}">
  @can('proveedor.destroy')
    <form method="post" action="{{ route('proveedor.destroy', Crypt::encrypt($proveedor->id)) }}" id="proveedorDestroy{{ $proveedor->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$proveedor->id", 'onclick' => "return check('btnsub$proveedor->id', 'proveedorDestroy$proveedor->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información (Contactos) y se alterarán los precios de los productos relacionados a este registro y a su vez el de los armados relacionados a los productos. ¿Estás seguro que quieres realizar esta acción para el registro: $proveedor->id ($proveedor->nom_comerc) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>