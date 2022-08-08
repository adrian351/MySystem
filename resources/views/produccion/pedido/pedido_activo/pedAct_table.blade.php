<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pedidos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr> 
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedidoUnificado')
          <th>{{ __('PEDIDO TERMINADO') }}</th>
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.fechaDeEntrega')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusProduccion')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.bodega')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.cliente')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.totalDeArmados')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pedidos as $pedido)
          @php
            $estilos = null;
            $clase = null; 
          @endphp
       
          @if($pedido->estat_produc == config('app.asignar_lider_de_pedido') OR $pedido->estat_produc == config('app.en_espera_de_almacen') OR $pedido->estat_produc == config('app.productos_completos') OR $pedido->estat_produc == config('app.en_produccion'))
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
            @if($pedido->estat_produc == config('app.asignar_lider_de_pedido') OR $pedido->estat_produc == config('app.en_espera_de_almacen') OR $pedido->estat_produc == config('app.productos_completos') OR $pedido->estat_produc == config('app.en_produccion'))
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['canany' => ['produccion.pedidoActivo.show', 'produccion.pedidoActivo.armado.show'], 'ruta' => route('produccion.pedidoActivo.show',  Crypt::encrypt($pedido->id))])
            @else
              @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['canany' => ['rastrea.pedido.show', 'rastrea.pedido.showFull'], 'ruta' => route('rastrea.pedido.show',  Crypt::encrypt($pedido->id)), 'target' => '_blank'])
            @endif

            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedidoUnificado')
           
            <td>
              @if ($pedido->arm_carg < 100 && $pedido->fech_de_entreg == null)
                  {{--  no hacemos nada  --}}
                @else
                  @if ($pedido->arm_carg >= 100  && $pedido->fech_de_entreg != null)
                    {{ $pedido->fecha_de_entrega =  date('d-m-Y', strtotime($pedido->fech_de_entreg. '- 2 days'))}}
                    
                  @endif
              @endif
            </td>
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.fechaDeEntrega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusProduccion')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.bodega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.cliente')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados')
            @if($pedido->estat_produc == config('app.asignar_lider_de_pedido') OR $pedido->estat_produc == config('app.en_espera_de_almacen') OR $pedido->estat_produc == config('app.productos_completos') OR $pedido->estat_produc == config('app.en_produccion'))
              @include('produccion.pedido.pedido_activo.pedAct_tableOpciones')
            @else
              <td></td>
              <td></td>
            @endif
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>