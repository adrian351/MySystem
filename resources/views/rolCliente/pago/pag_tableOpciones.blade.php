<td width="1rem" title="Facturar: {{ $pago->cod_fact }}">
  <a href="{{ route('rolCliente.factura.create') }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-file-invoice"></i></a>
</td>
<td width="1rem" title="Editar: {{ $pago->cod_fact }}">
  @if($pago->estat_pag == config('app.rechazado'))
    <a href="{{ route('rolCliente.pago.edit', Crypt::encrypt($pago->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endif
</td>