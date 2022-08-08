<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($cotizaciones) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('cotizacion.cot_table.th.serie')
          @include('cotizacion.cot_table.th.fechaCreacion')
          @include('cotizacion.cot_table.th.estatus')
          @include('cotizacion.cot_table.th.validez')
          @include('cotizacion.cot_table.th.total')
        </tr>
      </thead>
      <tbody> 
        @foreach($cotizaciones as $cotizacion)
          <tr title="{{ $cotizacion->id }}">
            @include('cotizacion.cot_table.td.serie', ['show' => true, 'canany' => ['cotizacion.show'], 'ruta' => 'cotizacion.show',  'target' => 'target="_blank"'])
            @include('cotizacion.cot_table.td.fechaCreacion')
            @include('cotizacion.cot_table.td.estatus')
            @include('cotizacion.cot_table.td.validez')
            @include('cotizacion.cot_table.td.total')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>