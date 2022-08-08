@if(Request::route()->getName() != 'logistica.direccionForaneo.show')
  <td width="1rem" title="Detalles: {{ $direccion->est }}">
    @can('logistica.direccionForaneo.show')
      <a href="{{ route('logistica.direccionForaneo.show', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-eye"></i></a>
    @endcan
  </td>
@endif
@if(Request::route()->getName() != 'logistica.direccionForaneo.edit')
  <td width="1rem" title="Editar: {{ $direccion->est }}">
    @if($direccion->estat != config('app.entregado') AND $direccion->estat != config('app.pendiente'))
      @can('logistica.direccionForaneo.edit')
        <a href="{{ route('logistica.direccionForaneo.edit', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
      @endcan
    @endif
  </td>
@endif
<td width="1rem" title="Generar comprobante de entrega: {{ $direccion->est }}">
  @if($direccion->estat != config('app.entregado') AND $direccion->estat != config('app.pendiente'))
    @can('logistica.direccionForaneo.index')
      <a href="{{ route('logistica.direccion.generarComprobanteDeEntrega', [Crypt::encrypt($direccion->id), config('opcionesSelect.select_foraneo_local.Foráneo')]) }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-file-pdf"></i></a>
    @endcan
  @endif
</td>
@if(Request::route()->getName() != 'logistica.direccionForaneo.create')
  <td width="1rem" title="Registrar comprobante de salida: {{ $direccion->est }}">
    @if($direccion->estat != config('app.entregado') AND $direccion->estat != config('app.pendiente') AND $direccion->nom_ref_uno != null)
      @can('logistica.direccionForaneo.create')
        <a href="{{ route('logistica.direccionForaneo.create', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-sign-out-alt"></i></a>
      @endcan
    @endif
  </td>
@endif
@if(Request::route()->getName() != 'logistica.direccionForaneo.createEntrega')
  <td width="1rem" title="Registrar comprobante de entrega: {{ $direccion->est }}">
    @if($direccion->estat != config('app.entregado') AND $direccion->estat != config('app.pendiente') AND $direccion->nom_ref_uno != null)
      @can('logistica.direccionForaneo.createEntrega')
        <a href="{{ route('logistica.direccionForaneo.createEntrega', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-truck"></i></a>
      @endcan
    @endif
  </td>
@endif