<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($soportes) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('SOLICITANTE') }}</th>
          <th>{{ __('EMPRESA') }}</th>
          <th>{{ __('ESTATUS') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($soportes as $soporte)
          <tr title="{{ $soporte->sol }}">
            <td width="1rem">{{ $soporte->id }}</td>
            <td>
              @can('soporte.show')
                <a href="{{ route('soporte.show', Crypt::encrypt($soporte->id)) }}" title="Detalles: {{ $soporte->sol }}">{{ $soporte->sol }}</a>
              @else
                {{ $soporte->sol }}
              @endcan
            </td>
            <td>{{ $soporte->emp }}</td>
            <td>{{ $soporte->est }}</td>
            @include('tecnologia_de_la_informacion.soporte.ti_sop_tableOpciones') 
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>