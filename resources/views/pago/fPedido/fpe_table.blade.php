<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pedidos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
          <th>{{ __('FECHA') }}</th>
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusPago')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.montoTotal')
          <th>{{ __('MONT. PAGADO') }}</th>
          <th>{{ __('MONT. POR PAGAR') }}</th>
          <th colspan="1">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pedidos as $pedido)
          <tr title="{{ $pedido->num_pedido }}">
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['canany' => ['rastrea.pedido.show', 'rastrea.pedido.showFull'], 'ruta' => route('rastrea.pedido.show', Crypt::encrypt($pedido->id)), 'target' => '_blank'])
            <td> {{ date('d-m-Y H:i:s', strtotime($pedido->created_at)) }}</td>
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.montoTotal')
            <td>
              ${{ Sistema::dosDecimales($pedido->mont_pagado) }}
            </td>
            <td>
              ${{ Sistema::dosDecimales($pedido->mont_tot_de_ped-$pedido->mont_pagado) }}
            </td>
            @if($pedido->estat_log !=  config('app.entregado'))
              @include('pago.fPedido.fpe_tableOpciones')
            @else
              <td></td>
            @endif
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>