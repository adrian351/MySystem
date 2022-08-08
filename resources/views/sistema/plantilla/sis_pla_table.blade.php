<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($plantillas) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('NOMBRE DE LA PLANTILLA') }}</th>
          <th>{{ __('MODULO') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($plantillas as $plantilla)
          <tr title={{ $plantilla->nom }}>
            <td width="1rem">{{ $plantilla->id }}</td>
            <td title="Detalles: {{ $plantilla->nom }}">
              @can('sistema.plantilla.show')
                <a href="{{ route('sistema.plantilla.show', Crypt::encrypt($plantilla->id)) }}">{{ $plantilla->nom }}</a>
              @else
                {{ $plantilla->nom }}
              @endcan
            </td>
            <td>{{ $plantilla->mod }}</td>
            @include('sistema.plantilla.sis_pla_tableOpciones') 
          </tr>
         @endforeach
      </tbody>
    @endif
  </table>
</div>