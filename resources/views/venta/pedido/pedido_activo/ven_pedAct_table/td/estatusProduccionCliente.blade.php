<td>
  @if($pedido->estat_alm == config('app.pendiente'))
    <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ config('app.pendiente') }}</span>
  @elseif(
    $pedido->estat_alm == config('app.asignar_persona_que_recibe') OR
    $pedido->estat_alm == config('app.en_espera_de_ventas') OR
    $pedido->estat_alm == config('app.en_espera_de_compra') OR
    $pedido->estat_alm == config('app.en_revision_de_productos') OR
    $pedido->estat_alm == config('app.productos_completos_terminado') OR
    $pedido->estat_produc == config('app.asignar_lider_de_pedido') OR
    $pedido->estat_produc == config('app.en_espera_de_almacen') OR
    $pedido->estat_produc == config('app.productos_completos') OR
    $pedido->estat_produc == config('app.en_produccion') OR
    $pedido->estat_produc == config('app.en_almacen_de_salida_terminado') OR
    $pedido->estat_log == config('app.en_espera_de_produccion')
  )
    <span class="badge" style="background:{{ config('app.color_m') }}">{{  config('app.en_produccion') }}</span>
  @elseif(
    $pedido->estat_alm == config('app.productos_completos_terminado') AND
    $pedido->estat_produc == config('app.en_almacen_de_salida_terminado') AND
    $pedido->estat_log == config('app.asignar_lider_de_pedido') OR
    $pedido->estat_log == config('app.en_almacen_de_salida')
  )
    <span class="badge" style="background:{{ config('app.color_h') }}">{{ config('app.en_almacen_de_salida') }}</span>
  @elseif(
    $pedido->estat_alm == config('app.productos_completos_terminado') AND
    $pedido->estat_produc == config('app.en_almacen_de_salida_terminado') AND
    $pedido->estat_log == config('app.en_ruta')
  )
    <span class="badge" style="background:{{ config('app.color_g') }}">{{ config('app.en_ruta') }}</span>
  @elseif($pedido->estat_log == config('app.entregado'))
    <span class="badge" style="background:{{ config('app.color_d') }}">{{ config('app.entregado') }}</span>
  @elseif(
    $pedido->estat_alm == config('app.productos_completos_terminado') AND
    $pedido->estat_produc == config('app.en_almacen_de_salida_terminado') AND
    $pedido->estat_log == config('app.sin_entrega_por_falta_de_informacion')
  )
   <span class="badge" style="background:{{ config('app.color_f') }}">{{ config('app.sin_entrega_por_falta_de_informacion') }}</span>
  @elseif(
    $pedido->estat_alm == config('app.productos_completos_terminado') AND
    $pedido->estat_produc == config('app.en_almacen_de_salida_terminado') AND
    $pedido->estat_log == config('app.intento_de_entrega_fallido')
  )
    <span class="badge" style="background:{{ config('app.color_f') }}">{{ onfig('app.intento_de_entrega_fallido') }}</span>
  @endif
</td>