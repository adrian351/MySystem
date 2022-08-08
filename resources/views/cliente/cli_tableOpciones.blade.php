<td width="1rem" title="Re enviar correo de bienvenida: {{ $cliente->nom }}">
  @if($cliente->email_verified_at == NULL)
    @can('cliente.create')
    <form action="{{ route('cliente.reEnviarCorreoBienvenida', Crypt::encrypt($cliente->id)) }}" id="clienteReEnviarCorreoBienvenida{{ $cliente->id }}">
      @method('POST')
      @csrf
      {!! Form::button('<i class="far fa-envelope"></i>', ['type' => 'submit', 'class' => 'btn btn-light btn-sm', 'id' => "btnsub1$cliente->id", 'onclick' => "return check('btnsub1$cliente->id', 'clienteReEnviarCorreoBienvenida$cliente->id', '¡Alerta!', '¿Estás seguro quieres re enviar el correo? se generara una nueva contraseña, $cliente->id ($cliente->nom)', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
    @endcan
  @endif
</td>
<td width="1rem" title="Editar: {{ $cliente->nom }}">
  @can('cliente.edit')
    <a href="{{ route('cliente.edit', Crypt::encrypt($cliente->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $cliente->nom }}">
  @can('cliente.destroy')
    <form method="post" action="{{ route('cliente.destroy', Crypt::encrypt($cliente->id)) }}" id="clienteDestroy{{ $cliente->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$cliente->id", 'onclick' => "return check('btnsub$cliente->id', 'clienteDestroy$cliente->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información (Registro de actividades, Quejas y sugerencias, Direcciones, Datos fiscales, Cotizaciones, Pedidos, Pagos y Facturas). ¿Estás seguro que quieres realizar esta acción para el registro: $cliente->id ($cliente->nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>