<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($facturas) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('factura.fac_table.th.id')
          @include('factura.fac_table.th.estatusFactura')
          @include('factura.fac_table.th.rfc')
          @include('factura.fac_table.th.nombreORazonSocial')
          @include('factura.fac_table.th.documentosFactura')
        </tr>
      </thead>
      <tbody> 
        @foreach($facturas as $factura)
          <tr title="{{ $factura->id }}">
            @include('factura.fac_table.td.id', ['show' => true, 'canany' => ['factura.show'], 'ruta' => 'factura.show', 'target' => null])
            @include('factura.fac_table.td.estatusFactura')
            @include('factura.fac_table.td.rfc')
            @include('factura.fac_table.td.nombreORazonSocial')
            @include('factura.fac_table.td.documentosFactura')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>