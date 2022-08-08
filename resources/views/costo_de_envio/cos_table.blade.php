<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($costos_de_envio) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('costo_de_envio.cos_table.th.#')
          @include('costo_de_envio.cos_table.th.estado')
          @include('costo_de_envio.cos_table.th.municipio')
          @include('costo_de_envio.cos_table.th.metodoDeEntrega')
          @include('costo_de_envio.cos_table.th.tipoDeEnvio')
          @include('costo_de_envio.cos_table.th.costoPorEnvio')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($costos_de_envio as $costo_de_envio)
          <tr title="{{ $costo_de_envio->id }}">
            @include('costo_de_envio.cos_table.td.#', ['show' => true, 'canany' => ['costoDeEnvio.show'], 'ruta' => 'costoDeEnvio.show', 'target' => null])
            @include('costo_de_envio.cos_table.td.estado')
            @include('costo_de_envio.cos_table.td.municipio')
            @include('costo_de_envio.cos_table.td.metodoDeEntrega')
            @include('costo_de_envio.cos_table.td.tipoDeEnvio')
            @include('costo_de_envio.cos_table.td.costoPorEnvio')
            @include('costo_de_envio.cos_tableOpciones')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>