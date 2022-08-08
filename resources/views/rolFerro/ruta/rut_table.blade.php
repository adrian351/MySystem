<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($rutas) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('NOMBRE') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody>
        @foreach($rutas as $ruta)
          <tr title="{{ $ruta->nom }}">
            <td width="1rem">{{ $ruta->rut }}</td>
            <td>
              <a href="{{ route('rolFerro.ruta.show', Crypt::encrypt($ruta->id)) }}" title="Detalles: {{ $ruta->nom }}">{{ $ruta->nom }}</a>
            </td>
            @include('rolFerro.ruta.rut_tableOpciones') 
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>