<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($roles) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('NOMBRE DEL ROL') }}</th>
          <th>{{ __('DESCRIPCIÓN') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($roles as $rol)
          <tr title="{{ $rol->nom }}">
            <td width="1rem">{{ $rol->id }}</td>
            <td>
              @can('rol.show')
                <a href="{{ route('rol.show', Crypt::encrypt($rol->id)) }}" title="Detalles: {{ $rol->nom }}">{{ $rol->nom }}</a>
              @else
                {{ $rol->nom }}
              @endcan
            </td>
            <td>{{ $rol->desc }}</td>
            @include('rol.rol.rol_rol_tableOpciones') 
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>