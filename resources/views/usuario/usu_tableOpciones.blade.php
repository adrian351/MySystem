<td width="1rem" title="Re enviar correo de bienvenida: {{ $usuario->nom }}">
  @if($usuario->email_verified_at == NULL)
    @can('usuario.create')
      <form action="{{ route('usuario.reEnviarCorreoBienvenida', Crypt::encrypt($usuario->id)) }}" id="usuarioReEnviarCorreoBienvenida{{ $usuario->id }}">
        @method('POST')
        @csrf
        {!! Form::button('<i class="far fa-envelope"></i>', ['type' => 'submit', 'class' => 'btn btn-light btn-sm', 'id' => "btnsub1$usuario->id", 'onclick' => "return check('btnsub1$usuario->id', 'usuarioReEnviarCorreoBienvenida$usuario->id', '¡Alerta!', '¿Estás seguro quieres re enviar el correo? se generara una nueva contraseña, $usuario->id ($usuario->nom)', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
      </form>
    @endcan
  @endif
</td>
<td width="1rem" title="Editar: {{ $usuario->nom }}">
  @can('usuario.edit')
    <a href="{{ route('usuario.edit', Crypt::encrypt($usuario->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $usuario->nom }}">
  @can('usuario.destroy')
    <form method="post" action="{{ route('usuario.destroy', Crypt::encrypt($usuario->id)) }}" id="usuarioDestroy{{ $usuario->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$usuario->id", 'onclick' => "return check('btnsub$usuario->id', 'usuarioDestroy$usuario->id', '¡Alerta!', 'Enviaras este registro a la papelera de reciclaje junto con toda su información (Registro de actividades, Quejas y sugerencias). ¿Estás seguro que quieres realizar esta acción para el registro: $usuario->id ($usuario->nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>