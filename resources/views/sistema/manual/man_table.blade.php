<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($manuales) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('VALOR') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($manuales as $manual)
          <tr title={{ $manual->id }}>
            <td width="1rem">{{ $manual->id }}</td>
            <td title="Detalles: {{ $manual->id }}">
              @can('manual.show')
                <a href="{{ route('manual.show', Crypt::encrypt($manual->id)) }}">{{ $manual->valor }}</a>
              @else
                {{ $manual->valor }}
              @endcan
            </td>
            @include('sistema.manual.man_tableOpciones') 
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>