<td width="1rem" title="Editar: {{ $pago->cod_fact }}">
  @if($pago->estat_pag == config('app.rechazado'))
    @can('venta.pedidoActivo.pago.edit')
      <a href="{{ route('pago.fPedido.edit', Crypt::encrypt($pago->id)) }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-edit"></i></a>
    @endcan
  @endif
</td>