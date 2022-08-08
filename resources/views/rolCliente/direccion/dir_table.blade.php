<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($direcciones) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('rolCliente.direccion.dir_table.th.id')
          @include('rolCliente.direccion.dir_table.th.nombreReferenciaUno')
          @include('rolCliente.direccion.dir_table.th.nombreReferenciaDos')
          @include('rolCliente.direccion.dir_table.th.pais')
          @include('rolCliente.direccion.dir_table.th.ciudad')
          @include('rolCliente.direccion.dir_table.th.colonia')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($direcciones as $direccion)
          <tr title="{{ $direccion->id }}">
            <td><a href="{{ route('rolCliente.direccion.show', Crypt::encrypt($direccion->id)) }}" title="Detalles: {{ $direccion->id }}">{{ $direccion->id }}</a></td>
            @include('rolCliente.direccion.dir_table.td.nombreReferenciaUno')
            @include('rolCliente.direccion.dir_table.td.nombreReferenciaDos')
            @include('rolCliente.direccion.dir_table.td.pais')
            @include('rolCliente.direccion.dir_table.td.ciudad')
            @include('rolCliente.direccion.dir_table.td.colonia')
            @include('rolCliente.direccion.dir_tableOpciones') 
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>