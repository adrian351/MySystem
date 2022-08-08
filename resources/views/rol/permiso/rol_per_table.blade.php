<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($permisos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('NOMBRE DEL PERMISO') }}</th>
          <th>{{ __('DESCRIPCIÓN') }}</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($permisos as $permiso)
          <tr title="{{ $permiso->nom }}">
            <td width="1rem">{{ $permiso->id }}</td>
            <td><a href="{{ route('rol.permiso.show', Crypt::encrypt($permiso->id)) }}" title="Detalles: {{ $permiso->nom }}">{{ $permiso->nom }}</a></td>
            <td>{{ $permiso->desc }}</td>
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>