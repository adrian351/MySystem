<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($facturas) == 0)
      <th>Sin resultados</th>
    @else 
      <thead>
        <tr>
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
          @include('factura.fac_table.th.cliente')
          <th>FECHA DE EMISIÓN</th>
          <th>MONTO FACTURADO</th>
          <th>NO. FACTURA CYA</th>
          <th>NO. REFACTURACION</th>
          <th>FECHA DE REFACTURACION</th>
          <th>MONTO</th>
          <th></th>
          @include('pago.pag_table.th.formaDePago')
        </tr>
      </thead>
      <tbody> 
        @foreach($facturas as $factura)
          <tr>
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedido', ['pedido' => $factura->pago->pedido])
            @include('factura.fac_table.td.nombreORazonSocial')
            <td>{{ $factura->fech_facturado }}</td>
            <td>{{ Sistema::dosDecimales($factura->pago->mont_de_pag) }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @include('pago.pag_table.td.formaDePago', ['pago' => $factura->pago])
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>