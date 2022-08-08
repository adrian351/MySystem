<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pedidos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr> 
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedidoUnificado')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.fechaDeEntrega')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusPago')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusProduccion')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.bodega')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusLogistica')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.cliente')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.totalDeArmados')
          <th colspan="1">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pedidos as $pedido)
          @php
            $estilos = null;
            $clase = null; 
          @endphp
       
          @if($pedido->estat_log == config('app.en_espera_de_produccion') OR $pedido->estat_log == config('app.en_almacen_de_salida') OR $pedido->estat_log == config('app.en_ruta') OR $pedido->estat_log == config('app.sin_entrega_por_falta_de_informacion') OR $pedido->estat_log == config('app.intento_de_entrega_fallido'))
          @else
            @php
              $estilos = 'background:#bcbcbc;';
              $clase = 'text-muted cursor-allowed'; 
            @endphp
          @endif

          @if($pedido->urg == 'Si')
            @php
              $estilos .= 'border:#FFF323 2px solid;';
            @endphp
          @endif

          @if($pedido->stock == 'Si')
            @php
              $estilos .= 'background-color: #ff000060';
            @endphp
          @endif

          <tr title="{{ $pedido->num_pedido }}" class="{{ $clase }}" style="{{ $estilos }}">
            @if($pedido->estat_log == config('app.en_espera_de_produccion') OR $pedido->estat_log == config('app.en_almacen_de_salida') OR $pedido->estat_log == config('app.en_ruta') OR $pedido->estat_log == config('app.sin_entrega_por_falta_de_informacion') OR $pedido->estat_log == config('app.intento_de_entrega_fallido'))
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['canany' => ['logistica.pedidoActivo.show', 'logistica.pedidoActivo.armado.show'], 'ruta' => route('logistica.pedidoActivo.show',  Crypt::encrypt($pedido->id))])
            @else
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['canany' => ['rastrea.pedido.show', 'rastrea.pedido.showFull'], 'ruta' => route('rastrea.pedido.show',  Crypt::encrypt($pedido->id)), 'target' => '_blank'])
            @endif
           
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedidoUnificado')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.fechaDeEntrega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusProduccion')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.bodega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusLogistica')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.cliente')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados')
            @if($pedido->estat_log == config('app.en_espera_de_produccion') OR $pedido->estat_log == config('app.en_almacen_de_salida') OR $pedido->estat_log == config('app.en_ruta') OR $pedido->estat_log == config('app.sin_entrega_por_falta_de_informacion') OR $pedido->estat_log == config('app.intento_de_entrega_fallido'))
              @include('logistica.pedido.pedido_activo.pedAct_tableOpciones')
            @else
              <td width="1rem"></td>
            @endif
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>