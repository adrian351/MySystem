<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pagos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('pago.pag_table.th.codigoDeFacturacion')
          @include('pago.pag_table.th.folio')
          <th>{{ __('FECHA') }}</th>
          @include('pago.pag_table.th.cliente')
          @include('factura.fac_table.th.estatusFactura')
          @include('pago.pag_table.th.estatusPago')
          @include('pago.pag_table.th.formaDePago')
          @include('pago.pag_table.th.montoDePago')
          @include('pago.pag_table.th.numeroDePedido')
          <th colspan="3">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pagos as $pago)
          {{--  mostrar registros que tengan un monto mayor a $1  --}}
           @if($pago->mont_de_pag >= 1)
              <tr title="{{ $pago->cod_fact }}">
                @include('pago.pag_table.td.codigoDeFacturacion', ['show' => true, 'canany' => ['pago.show'], 'ruta' => 'pago.show', 'target' => null])
                @include('pago.pag_table.td.folio')
                <td>{{ date('d-m-Y', strtotime($pago->created_at)) }}</td>
                @include('pago.pag_table.td.cliente')
                @include('factura.fac_table.td.estatusFactura', ['factura' => $pago])
                @include('pago.pag_table.td.estatusPago')
                @include('pago.pag_table.td.formaDePago')
                @include('pago.pag_table.td.montoDePago')
                @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['pedido' => $pago->pedido, 'canany' => ['rastrea.pedido.show', 'rastrea.pedido.showFull'], 'ruta' => route('rastrea.pedido.show', Crypt::encrypt($pago->pedido->id)), 'target' => '_blank'])
                @include('pago.individual.ind_tableOpciones')
              </tr>
            @endif
        @endforeach
      </tbody>
    @endif
  </table>
</div>
<br/>
<hr/>

<div id="accordion">
  <div class="card">
    <div class="card-header p-1 " id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         <h6> <i class="fas fa-arrow-right"></i>&nbsp;&nbsp;&nbsp; {{ __('Pagos con monto de $0.00') }}</h6>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 20em;">
          <table class="table table-head-fixed table-hover table-striped table-sm table-bordered"> 
              <thead>
                <tr>
                  @include('pago.pag_table.th.codigoDeFacturacion')
                  @include('pago.pag_table.th.folio')
                  <th>{{ __('FECHA') }}</th>
                  @include('pago.pag_table.th.cliente')
                  @include('factura.fac_table.th.estatusFactura')
                  @include('pago.pag_table.th.estatusPago')
                  @include('pago.pag_table.th.formaDePago')
                  @include('pago.pag_table.th.montoDePago')
                  @include('pago.pag_table.th.numeroDePedido')
                  <th colspan="3">&nbsp</th>
                </tr>
              </thead>
              <tbody> 
                @foreach($pagos as $pago)
                   @if($pago->mont_de_pag < 1)
                      <tr title="{{ $pago->cod_fact }}">
                        @include('pago.pag_table.td.codigoDeFacturacion', ['show' => true, 'canany' => ['pago.show'], 'ruta' => 'pago.show', 'target' => null])
                        @include('pago.pag_table.td.folio')
                        <td>{{ date('d-m-Y', strtotime($pago->created_at)) }}</td>
                        @include('pago.pag_table.td.cliente')
                        @include('factura.fac_table.td.estatusFactura', ['factura' => $pago])
                        @include('pago.pag_table.td.estatusPago')
                        @include('pago.pag_table.td.formaDePago')
                        @include('pago.pag_table.td.montoDePago')
                        @include('venta.pedido.pedido_activo.ven_pedAct_table.td.opcionShow', ['pedido' => $pago->pedido, 'canany' => ['rastrea.pedido.show', 'rastrea.pedido.showFull'], 'ruta' => route('rastrea.pedido.show', Crypt::encrypt($pago->pedido->id)), 'target' => '_blank'])
                        @include('pago.individual.ind_tableOpciones')
                      </tr>
                    @endif
                @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>