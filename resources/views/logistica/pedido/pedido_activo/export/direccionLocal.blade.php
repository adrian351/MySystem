<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 40em;"> 
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      @if(sizeof($direcciones) == 0)
        <th>Sin resultados</th>
      @else 
        <thead>
          <tr>
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.#')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.armado')
            @include('pago.pag_table.th.estatusPago')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.fechaDeEntrega')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.nombreDeReferenciaUno')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.cantidad')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.estatus')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.th.bodega')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntrega')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.estado')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.tipoDeEnvio')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.costo')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.delegacionOMunicipio')
          </tr>
        </thead>
        <tbody> 
          @foreach($direcciones as $direccion)
            <tr title="{{ $direccion->est }}">
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.#')
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.armado', ['show' => false])
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago', ['pedido' => $direccion->armado->pedido])
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.fechaDeEntrega')
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.nombreDeReferenciaUno')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.cantidad', ['show' => false])
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.estatus')
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.bodega', ['pedido' => $direccion->armado->pedido])
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntrega')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.estado')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.tipoDeEnvio')
              @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.costo')
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.delegacionOMunicipio')
            </tr>
          @endforeach
        </tbody>
      @endif
    </table>
  </div>
  