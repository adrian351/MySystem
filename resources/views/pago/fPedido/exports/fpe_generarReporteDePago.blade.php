<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    <thead>
      <tr>
        {{--  <th>{{ __('COD. FACTURACION') }}</th>  --}}
        @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
        <th>{{ __('FECHA') }}</th>
        @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusPago')
        @include('venta.pedido.pedido_activo.ven_pedAct_table.th.montoTotal')
        {{-- <th>{{ __('ESPACIO') }}</th> --}}
        <th>{{ __('FORM. DE PAGO') }}</th>
        <th>{{ __('PEDIDO DUPLICADO') }}</th>
        <th>{{ __('ESPACIO') }}</th>
        <th>{{ __('MONT. PAGADO') }}</th>
        <th>{{ __('MONT. POR PAGAR') }}</th>
      </tr>
    </thead>
    <tbody> 
      @foreach($pedidos as $pedido)
        <tr title="{{ $pedido->num_pedido }}">
          @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedido')
          <td>{{ date('d-m-Y H:i:s', strtotime($pedido->created_at)) }}</td>
          @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago')
          {{--  @include('venta.pedido.pedido_activo.ven_pedAct_table.td.montoTotal')  --}}
          <td>{{ $pedido->mont_tot_de_ped }}</td>
          @foreach ($pedido->pagos as $pago )
          {{-- falta checar por pagos que son clonados o solicitados mas de una vez --}}
           <td>{{ $pago->form_de_pag }}</td>
          
          @endforeach
          <td></td>
          <td></td>
          {{--  <td>{{ Sistema::dosDecimales($pedido->mont_pagado) }}</td>  --}}
          <td>{{ $pedido->mont_pagado }}</td>
          {{--  <td>{{ Sistema::dosDecimales($pedido->mont_tot_de_ped-$pedido->mont_pagado) }}</td>  --}}
          <td>{{ $pedido->mont_tot_de_ped-$pedido->mont_pagado }}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>