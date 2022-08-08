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
        <th colspan="1">&nbsp</th>
      </tr>
    </thead>
    <tbody> 
        @foreach($armados as $armado)
        @if($armado->estat == config('app.en_espera_de_compra') OR $armado->estat == config('app.en_revision_de_productos'))
          <tr title="{{ $armado->cod }}">
        @else
          <tr title="{{ $armado->cod }}" class="text-muted cursor-allowed" style="background:#bcbcbc">
        @endif
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.#', ['show' => true, 'canany' => ['almacen.pedidoActivo.armado.show', 'almacen.pedidoActivo.show'], 'ruta' => 'almacen.pedidoActivo.armado.show'])
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.estatus')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.cantidad')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.tipo')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.armado')
          @if(Request::route()->getName() == 'almacen.pedidoActivo.edit')
            @include('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_tableOpciones')
          @else
            <td></td>
          @endif
        </tr>
        @endforeach
    </tbody>
    @endif
  </table>
</div>