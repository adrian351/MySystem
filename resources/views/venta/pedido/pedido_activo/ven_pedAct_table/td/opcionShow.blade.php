<td>
  @canany($canany)
    <a href="{{ $ruta }}" title="Detalles: {{ $pedido->num_pedido }}" target="{{ empty($target) ? __('') :  $target }}">{{ $pedido->num_pedido }}</a>
    @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
  @else
    {{ $pedido->num_pedido }}
  @endcanany
</td>