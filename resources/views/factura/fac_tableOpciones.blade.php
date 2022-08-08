<td width="1rem" title="Subir archivos de factura: {{ $factura->sku }}">
  @can('factura.edit')
    <a href="{{ route('factura.subirArchivos', Crypt::encrypt($factura->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-arrow-circle-up"></i></a>
  @endcan
</td>
<td width="1rem" title="Editar: {{ $factura->sku }}">
  @if($factura->est_fact != config('app.facturado'))
    @can('factura.edit')
      <a href="{{ route('factura.edit', Crypt::encrypt($factura->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  @endif
</td>
<td width="1rem" title="Eliminar: {{ $factura->sku }}">
  @can('factura.destroy')
    <form method="post" action="{{ route('factura.destroy', Crypt::encrypt($factura->id)) }}" id="facturaDestroy{{ $factura->id }}">
      @method('DELETE')@csrf
      {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'id' => "btnsub$factura->id", 'onclick' => "return check('btnsub$factura->id', 'facturaDestroy$factura->id', '¡Alerta!', 'Eliminaras permanentemente este registro junto con toda su información. ¿Estás seguro que quieres realizar esta acción para el registro: $factura->id ($factura->rfc) ?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
    </form>
  @endcan
</td>