<td width='1rem' title="Editar: {{ $inventario->id_equipo}}">
  @can(['inventario.edit'])
    <a href="{{ route('inventario.edit', Crypt::encrypt($inventario->id))}}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endcan
</td>
<td width='1rem' title="Eliminar: {{ $inventario->id_equipo}}">
  @can('inventario.destroy')
    <form method="post" action="{{ route('inventario.destroy', Crypt::encrypt($inventario->id))}}" id="inventarioDestroy{{ $inventario->id}}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$inventario->id", 'onclick' => "return check('btnsub$inventario->id', 'inventarioDestroy$inventario->id', '¡Alerta!', '¿Estas seguro quieres eliminar el resgistro, $inventario->id ($inventario->id_equipo) ?', 'info', 'Continuar', 'Cancelar', 'false');"])!!}
    </form>
  @endcan
</td>