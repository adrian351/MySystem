<td width="1rem" title="Clonar: {{ $armado->nom }}">
  <form method="post" action="{{ route('cotizacion.armado.clonar', Crypt::encrypt($armado->id)) }}" id="cotizacionArmadoClonar{{ $armado->id }}">
    @method('GET')@csrf
    {!! Form::button('<i class="far fa-clone"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-sm', 'id' => "btncotizacionArmadoClonar$armado->id", 'onclick' => "return check('btncotizacionArmadoClonar$armado->id', 'cotizacionArmadoClonar$armado->id', '¡Alerta!', '¿Estás seguro quieres clonar el registro en el módulo Armados, $armado->id ($armado->sku) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
  </form>
</td>
<td width="1rem" title="Editar: {{ $armado->nom }}">
  <a href="{{ route('cotizacion.armado.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
</td>
<td width="1rem" title="Eliminar: {{ $armado->nom }}">
  <form method="post" action="{{ route('cotizacion.armado.destroy', Crypt::encrypt($armado->id)) }}" id="cotizacionArmadoDestroy{{ $armado->id }}">
    @method('DELETE')@csrf
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$armado->id", 'onclick' => "return check('btnsub$armado->id', 'cotizacionArmadoDestroy$armado->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $armado->id ($armado->nom) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
  </form>
</td> 