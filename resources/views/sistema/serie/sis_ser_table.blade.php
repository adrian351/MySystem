<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($series) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('ULT. SERIE') }}</th>
          <th>{{ __('INPUT') }}</th>
          <th>{{ __('VISTA') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($series as $serie)
          <tr title={{ $serie->id }}>
            <td width="1rem">{{ $serie->id }}</td>
            <td width="1rem">{{ $serie->ult_ser }}</td>
            <td>{{ $serie->input }}</td>
            <td title="Detalles: {{ $serie->id }}">
              @can('sistema.serie.show')
                <a href="{{ route('sistema.serie.show', Crypt::encrypt($serie->id)) }}">{{ $serie->vista }}</a>
              @else
                {{ $serie->vista }}
              @endcan
            </td>
            @include('sistema.serie.sis_ser_tableOpciones') 
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>