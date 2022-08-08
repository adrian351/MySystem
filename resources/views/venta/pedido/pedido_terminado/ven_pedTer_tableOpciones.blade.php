<td width="1rem" title="Eliminar: {{ $pedido->num_pedido }}">
  @can('venta.pedidoTerminado.destroy')
    <form method="post" action="{{ route('venta.pedidoTerminado.destroy', Crypt::encrypt($pedido->id)) }}" id="ventaPedidoTerminadoDestroy{{ $pedido->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$pedido->id", 'onclick' => "return check('btnsub$pedido->id', 'ventaPedidoTerminadoDestroy$pedido->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información (Armados, Productos, Direcciones, Pagos, Facturas). ¿Estás seguro que quieres realizar esta acción para el registro: $pedido->num_pedido (".$pedido->usuario->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>