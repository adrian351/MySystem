<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($usuarios) == 0)
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
        @foreach($usuarios as $usuario)
          <tr title="{{ $usuario->nom }}">
            <td width="1rem">{{ $usuario->id }}</td>
            <td>
              @can('usuario.show')
                <a href="{{ route('usuario.show', Crypt::encrypt($usuario->id)) }}" title="Detalles: {{ $usuario->nom }}">{{ $usuario->nom . ' ' . $usuario->apell }}</a>
              @else
                {{ $usuario->nom }}
              @endcan
            </td>
            <td>{{ $usuario->email_registro }}</td>
            <td>{{ $usuario->email }}</td>
            {{-- linea comentada por marcar error --}}
            {{-- <td>{{ $usuario->getRoleNom()->implode(', ') }}</td> --}}
            <td>
              @foreach ($usuario->roles as $rol)
                {{ $rol->nom.", " }}
              @endforeach
            </td>
            {{-- <!-- Funcion declarada en Spatie\Permission\Traits\HasRole --> --}}
            @include('usuario.usu_tableOpciones') 
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>