<td title="Aprobar o Rechazar: {{ $pago->cod_fact }}">
  @can('pago.edit')
    <a href="{{ route('pago.edit', Crypt::encrypt($pago->id)) }}" class='btn btn-info btn-sm' target="_blank">{{ __('Aprobar o Rechazar') }}</a>
  @endcan
</td>
<td width="1rem" title="Editar: {{ $pago->cod_fact }}">
  @if($pago->estat_pag == config('app.rechazado'))
    @canany(['pago.fPedido.edit', 'venta.pedidoActivo.pago.edit'])
      <a href="{{ route('pago.fPedido.edit', Crypt::encrypt($pago->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcanany
  @endif
</td>