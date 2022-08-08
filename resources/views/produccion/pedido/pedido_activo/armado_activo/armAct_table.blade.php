<span class="text-danger border border-danger row">{{ $errors->first('ubicacion_rack') }}</span>
<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 20em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @if($pedido->lid_de_ped_produc == null)
        {{--  @include('layouts.private.busquedaSinResultados', ['mensaje' => __('Falta asignar líder de pedido')])  --}}
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
        <th colspan="2">&nbsp</th>
      </tr>
    </thead>
    <tbody> 
      @foreach($armados as $armado)
      @if($armado->estat == config('app.productos_completos') OR $armado->estat == config('app.en_produccion'))
        <tr title="{{ $armado->cod }}">
      @else
        <tr title="{{ $armado->cod }}" class="text-muted cursor-allowed" style="background:#bcbcbc">
      @endif
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.#', ['show' => true, 'canany' => ['produccion.pedidoActivo.armado.show', 'produccion.pedidoActivo.show'], 'ruta' => 'produccion.pedidoActivo.armado.show'])
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.estatus')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.cantidad')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.tipo')
        @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.armado')
        {{--  agregar un rack  --}}
        @if(Request::route()->getName() == 'produccion.pedidoActivo.edit')
          @include('produccion.pedido.pedido_activo.armado_activo.armAct_tableOpciones')
        @else
          <td></td>
        @endif
      </tr>
      @endforeach
    </tbody>
    @endif
  </table>
</div>