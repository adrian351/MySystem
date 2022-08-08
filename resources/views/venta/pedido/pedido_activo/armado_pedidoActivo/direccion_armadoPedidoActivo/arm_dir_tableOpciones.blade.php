<td width="1rem" title="Editar: {{ $direccion->est }}">
  @can('venta.pedidoActivo.armado.edit')
    <a href="{{ route('venta.pedidoActivo.armado.direccion.edit', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
{{--  Sin uso, pero funcionando  --}}
{{--  
<td width="1rem" title="Eliminar: {{ $direccion->est }}">
  @can('venta.pedidoActivo.armado.edit')
    <form method="post" action="{{ route('venta.pedidoActivo.armado.direccion.destroy', Crypt::encrypt($direccion->id)) }}" id="ventaPedidoActivoArmadoDireccionDestroy{{ $direccion->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$direccion->id", 'onclick' => "return check('btnsub$direccion->id', 'ventaPedidoActivoArmadoDireccionDestroy$direccion->id', '¡Alerta!', '¿Estás seguro que quieres realizar esta acción para el registro:  $direccion->cod, $direccion->est ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>  --}}