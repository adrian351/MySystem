<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($quejas_y_sugerencias) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('queja_y_sugerencia.qsu_table.th.id')
          @include('queja_y_sugerencia.qsu_table.th.usuario')
          @include('queja_y_sugerencia.qsu_table.th.tipo')
          @include('queja_y_sugerencia.qsu_table.th.departamento')
          <th>{{ __('FECHA') }}</th>
          @include('queja_y_sugerencia.qsu_table.th.observaciones')
        </tr>
      </thead>
      <tbody> 
        @foreach($quejas_y_sugerencias as $queja_y_sugerencia)
          <tr title="{{ $queja_y_sugerencia->id }}">
            @include('queja_y_sugerencia.qsu_table.td.id')
            @include('queja_y_sugerencia.qsu_table.td.usuario')
            @include('queja_y_sugerencia.qsu_table.td.tipo')
            @include('queja_y_sugerencia.qsu_table.td.departamento')
            <td>{{ date('d-m-Y', strtotime($queja_y_sugerencia->created_at)) }}</td>
            @include('queja_y_sugerencia.qsu_table.td.observaciones')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>