<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($clientes) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('NOMBRE') }}</th>
          <th>{{ __('CORREO DE REGISTRO') }}</th>
          <th>{{ __('CORREO PARA ACCEDER') }}</th>
          <th>{{ __('ROL') }}</th>
          <th colspan="3">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($clientes as $cliente)
          <tr title="{{ $cliente->nom }}">
            <td width="1rem">{{ $cliente->id }}</td>
            <td>
              @can('cliente.show')
                <a href="{{ route('cliente.show', Crypt::encrypt($cliente->id)) }}" title="Detalles: {{ $cliente->nom }}">{{ $cliente->nom . ' ' . $cliente->apell }}</a>
              @else
                {{ $cliente->nom }}
              @endcan
            </td>
            <td>{{ $cliente->email_registro }}</td>
            <td>{{ $cliente->email }}</td>
            {{-- linea comentada por marcar error --}}
            {{-- <td>{{ $cliente->getRoleNom()->implode(', ') }}</td>  --}}
            <td>
              @foreach ($cliente->roles as $rol)
                {{ $rol->nom }}
              @endforeach
            </td>
            {{-- <!-- Funcion declarada en Spatie\Permission\Traits\HasRole --> --}}
            @include('cliente.cli_tableOpciones') 
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>