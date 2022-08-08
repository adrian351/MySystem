<td width="1rem" title="Editar: {{ $factura->id }}">
  @if($factura->est_fact ==  config('app.error_del_cliente'))
    <a href="{{ route('rolCliente.factura.edit', Crypt::encrypt($factura->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
  @endif
</td>