<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($datos_fiscales) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('rolCliente.datoFiscal.dfi_table.th.id')
          @include('rolCliente.datoFiscal.dfi_table.th.rfc')
          @include('rolCliente.datoFiscal.dfi_table.th.nombleRazonSocial')
        </tr>
      </thead>
      <tbody> 
        @foreach($datos_fiscales as $dato_fiscal)
          <tr title="{{ $dato_fiscal->id }}">
            <td>
              @can('cliente.show')
                <a href="{{ route('cliente.show.datoFiscal.show', Crypt::encrypt($dato_fiscal->id)) }}" title="Detalles: {{ $dato_fiscal->id }}">{{ $dato_fiscal->id }}</a>
              @else
                {{ $dato_fiscal->id }}
              @endcan
            </td>
            @include('rolCliente.datoFiscal.dfi_table.td.rfc')
            @include('rolCliente.datoFiscal.dfi_table.td.nombleRazonSocial')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>