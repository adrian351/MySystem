<div class="card-body table-responsive p-0" id="div-tabla-scrollbar3" style="height: 20em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pagos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr> 
          @include('pago.pag_table.th.codigoDeFacturacion')
          @include('factura.fac_table.th.estatusFactura')
          @include('pago.pag_table.th.estatusPago')
          @include('pago.pag_table.th.formaDePago')
          @include('pago.pag_table.th.montoDePago')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pagos as $pago)
          <tr title="{{ $pago->cod_fact }}">
            @include('pago.pag_table.td.codigoDeFacturacion', ['show' => true, 'canany' => ['venta.pedidoActivo.pago.show', 'venta.pedidoActivo.show'], 'ruta' => 'pago.fPedido.show', 'target' => 'target="_blank"'])
            @include('factura.fac_table.td.estatusFactura', ['factura' => $pago])
            @include('pago.pag_table.td.estatusPago')
            @include('pago.pag_table.td.formaDePago')
            @include('pago.pag_table.td.montoDePago')
            @if(Request::route()->getName() == 'venta.pedidoActivo.edit')
              @include('venta.pedido.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_tableOpciones')
            @else
              <td width="1rem"></td>
              <td width="1rem"></td>
            @endif
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>