<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
    <thead>
      <tr>
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.#')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.estatus')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.cantidad')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.tipo')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.armado')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.ubicacionRack')
      </tr>
    </thead>
    <tbody> 
      @foreach($armados as $armado)
      @if($armado->estat == config('app.en_almacen_de_salida') OR $armado->estat == config('app.en_ruta') OR $armado->estat == config('app.sin_entrega_por_falta_de_informacion') OR $armado->estat == config('app.intento_de_entrega_fallido'))
        <tr title="{{ $armado->cod }}">
      @else
        <tr title="{{ $armado->cod }}" class="text-muted cursor-allowed" style="background:#bcbcbc">
      @endif
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.#', ['show' => true, 'canany' => ['logistica.pedidoEntregado.armado.show', 'logistica.pedidoEntregado.show'], 'ruta' => 'logistica.pedidoEntregado.armado.show'])
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.estatus')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.cantidad')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.tipo')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.armado')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.ubicacionRack')
      </tr>
      @endforeach
    </tbody>
    @endif
  </table>
</div>