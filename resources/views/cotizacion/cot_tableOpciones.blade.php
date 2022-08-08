@if($cotizacion->estat == config('app.abierta'))
  <td width="1rem" title="Editar: {{ $cotizacion->serie }}">
    @can('cotizacion.edit')
      <a href="{{ route('cotizacion.edit', Crypt::encrypt($cotizacion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  </td>
  <td width="1rem" title="Generar: {{ $cotizacion->serie }}">
    @can('cotizacion.index', 'cotizacion.show', 'cotizacion.edit')
      <a href="{{ route('cotizacion.generarCotizacion', Crypt::encrypt($cotizacion->id)) }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-file-pdf"></i></a>
    @endcan
  </td>
  <td width="1rem" title="Clonar cotización: {{ $cotizacion->serie }}">
    @can('cotizacion.edit')
      <form action="{{ route('cotizacion.clonar', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionClonar{{ $cotizacion->id }}">
        @method('POST')@csrf
        {!! Form::button('<i class="far fa-clone"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-sm', 'id' => "btnClo$cotizacion->id", 'onclick' => "return check('btnClo$cotizacion->id', 'cotizacionClonar$cotizacion->id', '¡Alerta!', '¿Estás seguro quieres clonar la cotización, $cotizacion->serie (".$cotizacion->cliente->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
      </form>
    @endcan
  </td>
  <td width="1rem" title="Aprobar cotización: {{ $cotizacion->serie }}">
    @can('cotizacion.edit')
      <form action="{{ route('cotizacion.aprobar', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionAprobar{{ $cotizacion->id }}">
        @method('POST')@csrf
        {!! Form::button('<i class="fas fa-check"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-sm', 'id' => "btnApro$cotizacion->id", 'onclick' => "return check('btnApro$cotizacion->id', 'cotizacionAprobar$cotizacion->id', '¡Alerta!', '¿Estás seguro quieres aprobar la cotización, $cotizacion->serie (".$cotizacion->cliente->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
      </form>
    @endcan
  </td>
  <td width="1rem" title="Cancelar cotización: {{ $cotizacion->serie }}">
    @can('cotizacion.edit')
      <form action="{{ route('cotizacion.cancelar', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionCancelar{{ $cotizacion->id }}">
        @method('POST')@csrf
        {!! Form::button('<i class="fas fa-ban"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnCan$cotizacion->id", 'onclick' => "return check('btnCan$cotizacion->id', 'cotizacionCancelar$cotizacion->id', '¡Alerta!', '¿Estás seguro quieres cancelar la cotización, $cotizacion->serie (".$cotizacion->cliente->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
      </form>
    @endcan
  </td>
@else
  <td width="1rem"></td>
  {{--  <td width="1rem"></td>  --}}
  <td width="1rem"></td>
  <td width="1rem"></td>
  <td width="1rem"></td>
  <td width="1rem" title="Generar: {{ $cotizacion->serie }}">
    @can('cotizacion.index', 'cotizacion.show', 'cotizacion.edit')
      <a href="{{ route('cotizacion.generarCotizacion', Crypt::encrypt($cotizacion->id)) }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-file-pdf"></i></a>
    @endcan
  </td>
  
@endif


<td width="1rem" title="Eliminar: {{ $cotizacion->serie }}">
  @can('cotizacion.destroy')
    <form method="post" action="{{ route('cotizacion.destroy', Crypt::encrypt($cotizacion->id)) }}" id="cotizacionDestroy{{ $cotizacion->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnDes$cotizacion->id", 'onclick' => "return check('btnDes$cotizacion->id', 'cotizacionDestroy$cotizacion->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información (Armados, Productos y Direcciones). ¿Estás seguro que quieres realizar esta acción para el registro: $cotizacion->serie (".$cotizacion->cliente->email_registro.") ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>