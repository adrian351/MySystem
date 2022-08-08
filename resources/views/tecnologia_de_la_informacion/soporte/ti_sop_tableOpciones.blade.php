<td width="1rem" title="Editar: {{ $soporte->sol }}">
  @can('soporte.edit')
    <a href="{{ route('soporte.edit', Crypt::encrypt($soporte->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width="1rem" title="Eliminar: {{ $soporte->sku }}">
  @can('soporte.destroy')
    <form method="post" action="{{ route('soporte.destroy', Crypt::encrypt($soporte->id)) }}" id="soporteDestroy{{ $soporte->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$soporte->id", 'onclick' => "return check('btnsub$soporte->id', 'soporteDestroy$soporte->id', '¡Alerta!', '¿Estás seguro quieres eliminar el registro, $soporte->id ($soporte->sol) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>