<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($facturas) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('factura.fac_table.th.id')
          @include('factura.fac_table.th.estatusFactura')
          @include('pago.pag_table.th.estatusPago')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
          @include('factura.fac_table.th.cliente')
          @include('factura.fac_table.th.rfc')
          @include('factura.fac_table.th.nombreORazonSocial')
          @include('factura.fac_table.th.documentosFactura')
          <th colspan="3">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($facturas as $factura)
          <tr title="{{ $factura->rfc }}">
            @include('factura.fac_table.td.id', ['show' => true, 'canany' => ['factura.show'], 'ruta' => 'factura.show', 'target' => null])
            @include('factura.fac_table.td.estatusFactura')
            @include('pago.pag_table.td.estatusPago', ['pago' => $factura->pago])
            <td>
              @canany(['cotizacion.show'])
                <a href="{{ route('cotizacion.showPorNumPedido', Crypt::encrypt($factura->pago->pedido->num_pedido)) }}" title="Detalles: {{ $factura->pago->pedido->num_pedido }}" target="_blank">{{ $factura->pago->pedido->num_pedido }}</a>
              @else
                {{ $factura->pago->pedido->num_pedido }}
              @endcanany
            </td>
            @include('factura.fac_table.td.cliente')
            @include('factura.fac_table.td.rfc')
            @include('factura.fac_table.td.nombreORazonSocial')
            @include('factura.fac_table.td.documentosFactura')
            @include('factura.fac_tableOpciones')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>