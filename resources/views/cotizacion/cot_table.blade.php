<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($cotizaciones) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('cotizacion.cot_table.th.serie')
          @include('cotizacion.cot_table.th.numPedGen')
          @include('cotizacion.cot_table.th.ultimaModificacion')
          @include('cotizacion.cot_table.th.estatus')
          @include('cotizacion.cot_table.th.validez')
          @include('cotizacion.cot_table.th.correo')
          @include('cotizacion.cot_table.th.total')
          <th colspan="6">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($cotizaciones as $cotizacion)
          <tr title="{{ $cotizacion->serie }}">
            @include('cotizacion.cot_table.td.serie', ['show' => true, 'canany' => ['cotizacion.show'], 'ruta' => 'cotizacion.show',  'target' => null])
            @include('cotizacion.cot_table.td.numPedGen')
            @include('cotizacion.cot_table.td.ultimaModificacion')
            @include('cotizacion.cot_table.td.estatus')
            @include('cotizacion.cot_table.td.validez')
            @include('cotizacion.cot_table.td.correo')
            @include('cotizacion.cot_table.td.total')
            @include('cotizacion.cot_tableOpciones')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>