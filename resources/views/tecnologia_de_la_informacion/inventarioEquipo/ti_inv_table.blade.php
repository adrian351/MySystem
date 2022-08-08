<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if (sizeof($inventarios) == 0)
        @include('layouts.private.busquedaSinResultados')
    @else
      <thead>
        <th>{{ __('ID') }}</th>
        <th>{{ __('ID EQUIPO')}}</th>
        <th>{{ __('MARCA')}}</th>
        <th>{{ __('NUM. SERIE')}}</th>
        <th>{{ __('PROXIMO MANTENIMIENTO')}}</th>
        <th>{{ __('EMPRESA')}}</th>
        <th>{{ __('RESPONSABLE')}}</th>
        <th><th colspan="2">&nbsp</th></th>
      </thead>
      <tbody>
        @foreach($inventarios as $inventario)
          <tr title="{{ $inventario->id_equipo }}">
            <td width="1rem">{{ $inventario->id }}</td>
            <td>
              @can('inventario.show')
                <a href="{{ route('inventario.show', Crypt::encrypt($inventario->id))}}" title="Detalles: {{ $inventario->id_equipo}}">{{ $inventario->id_equipo}}</a>
              @else
                {{ $inventario->id_equipo}}
              @endcan
            </td>
            <td>{{ $inventario->mar}}</td>
            <td>{{ $inventario->num_ser}}</td>
            <td>{{ $inventario->prox_fec_de_man}}</td>
            <td>{{ $inventario->emp}}</td>
            <td>{{ $inventario->resp}}</td>
            @include('tecnologia_de_la_informacion.inventarioEquipo.ti_inv_tablaOpciones')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>