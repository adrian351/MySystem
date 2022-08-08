<td width="1rem" title="Editar: {{ $dato_fiscal->id }}">
  <a href="{{ route('rolCliente.datoFiscal.edit', Crypt::encrypt($dato_fiscal->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
</td>
<td width="1rem" title="Eliminar: {{ $dato_fiscal->id }}">
  <form method="post" action="{{ route('rolCliente.datoFiscal.destroy', Crypt::encrypt($dato_fiscal->id)) }}" id="rolClienteDatoFiscalDestroy{{ $dato_fiscal->id }}">
    @method('DELETE')@csrf
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$dato_fiscal->id", 'onclick' => "return check('btnsub$dato_fiscal->id', 'rolClienteDatoFiscalDestroy$dato_fiscal->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $dato_fiscal->id ($dato_fiscal->rfc) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
  </form>
</td>