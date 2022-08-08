@if($cotizacion->tot_arm >=50 AND $cotizacion->desc == 0)
  <tr>
    <td>
      <strong>
        <h5>{{ __('ESTE PEDIDO ES ACREEDOR A') }} {{ intval($cotizacion->tot_arm/50) }} {{ __('ARCÓN DE REGALO') }}</h5>
      </strong>
    </td>
  </tr>
@endif