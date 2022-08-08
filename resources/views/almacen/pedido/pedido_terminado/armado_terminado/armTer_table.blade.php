<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 25em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @if($pedido->per_reci_alm == null)
        @include('layouts.private.busquedaSinResultados', ['mensaje' => __('Falta asignar persona que recibe')])
      @else
        @include('layouts.private.busquedaSinResultados')
      @endif
    @else 
    <thead>
      <tr>
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.#')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.estatus')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.cantidad')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.tipo')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.armado')
      </tr>
    </thead>
    <tbody> 
        @foreach($armados as $armado)
        <tr title="{{ $armado->cod }}">
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.#', ['show' => true, 'canany' => ['almacen.pedidoTerminado.show'], 'ruta' => 'almacen.pedidoTerminado.armado.show'])
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.estatus')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.cantidad')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.tipo')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.armado')
        </tr>
        @endforeach
    </tbody>
    @endif
  </table>
</div>