<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 40em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.armado') 
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.#') 
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.nombreDeReferenciaUno')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.cantidad')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.estatus')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.estado')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.costo')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.colonia')
          <th colspan="1">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($armados as $armado)
          @foreach($armado->direcciones as $direccion)
            <tr title="{{ $direccion->est }}">
              {{--  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.armado')   --}}
              <td>{{ $armado->nom }}({{ $armado->sku }})</td>
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.#') 
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.nombreDeReferenciaUno')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.cantidad', ['show' => true, 'canany' => ['venta.pedidoActivo.armado.show', 'venta.pedidoActivo.show'], 'ruta' => 'venta.pedidoActivo.armado.direccion.show', 'target' => null])
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.estatus')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.estado')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.costo')
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.colonia')
              @include('rolCliente.pedido.armado.direccion.dir_tableOpciones')
            </tr>
          @endforeach
        @endforeach
      </tbody>
    @endif
  </table>
</div>