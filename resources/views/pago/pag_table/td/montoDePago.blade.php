<td>
  ${{ Sistema::dosDecimales($pago->mont_de_pag) }}

  @if($pago->pedido->con_iva == 'on')
    ({{ __('Con IVA') }})
  @else
    ({{ __('Sin IVA') }})
  @endif
</td>