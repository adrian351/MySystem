<td width="1rem" title="Editar: {{ $contacto->nom }}">
  @can('proveedor.contacto.edit')
    <a href="{{ route('proveedor.contacto.edit', Crypt::encrypt($contacto->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $contacto->nom }}">
  @can('proveedor.contacto.destroy')
    <form method="post" action="{{ route('proveedor.contacto.destroy', Crypt::encrypt($contacto->id)) }}" id="proveedorContactoDestroy{{ $contacto->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$contacto->id", 'onclick' => "return check('btnsub$contacto->id', 'proveedorContactoDestroy$contacto->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $contacto->id ($contacto->nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>