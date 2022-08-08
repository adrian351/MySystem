<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if (sizeof($historiales) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else        
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('TECNICO')}}</th>
          <th>{{ __('FECHA DE ENTREGA')}}</th>
          <th>{{ __('AGRUPACION DE FALLAS')}}</th>
          <th>{{ __('AREA O DEPARTAMENTO')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($historiales as $historial)
          <tr title="{{ $historial->sol }}">
            <td width="1rem">{{ $historial->id}}</td>
            <td>
              @can('inventario.show')
                <a href="{{ route('inventario.historial.show', Crypt::encrypt($historial->id)) }}" title="Detalles: {{ $historial->tec  }}">{{ $historial->tec }}</a>
              @else
                {{ $historial->tec }}
              @endcan              
            </td>
            <td>{{ $historial->fec_ent}}</td>
            <td>{{ $historial->grup_de_falla}}</td>
            <td>{{ $historial->area_dep}}</td>
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>