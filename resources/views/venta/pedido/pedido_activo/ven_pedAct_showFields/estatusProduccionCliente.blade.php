@if($pedido->estat_alm == config('app.pendiente'))
  @php 
    $borde = config('app.color_a');
    $estatus = config('app.pendiente');
  @endphp
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
  @php 
    $borde = config('app.color_m');
    $estatus = config('app.en_produccion');
  @endphp
@elseif(
$pedido->estat_alm == config('app.productos_completos_terminado') AND
$pedido->estat_produc == config('app.en_almacen_de_salida_terminado') AND
$pedido->estat_log == config('app.asignar_lider_de_pedido') OR
$pedido->estat_log == config('app.en_almacen_de_salida')
)
  @php 
    $borde = config('app.color_h');
    $estatus = config('app.en_almacen_de_salida');
  @endphp
@elseif(
$pedido->estat_alm == config('app.productos_completos_terminado') AND
$pedido->estat_produc == config('app.en_almacen_de_salida_terminado') AND
$pedido->estat_log == config('app.en_ruta')
)
  @php 
    $borde = config('app.color_g');
    $estatus = config('app.en_ruta');
  @endphp
@elseif($pedido->estat_log == config('app.entregado'))
<span class="badge" style="background:{{ config('app.color_d') }}">{{ config('app.entregado') }}</span>
@elseif(
$pedido->estat_alm == config('app.productos_completos_terminado') AND
$pedido->estat_produc == config('app.en_almacen_de_salida_terminado') AND
$pedido->estat_log == config('app.sin_entrega_por_falta_de_informacion')
)
  @php 
    $borde = config('app.color_f');
    $estatus = config('app.sin_entrega_por_falta_de_informacion');
  @endphp
@elseif(
$pedido->estat_alm == config('app.productos_completos_terminado') AND
$pedido->estat_produc == config('app.en_almacen_de_salida_terminado') AND
$pedido->estat_log == config('app.intento_de_entrega_fallido')
)
  @php 
    $borde = config('app.color_f');
    $estatus = config('app.intento_de_entrega_fallido');
  @endphp
@else
  @php 
    $borde = null;
    $estatus = null;
  @endphp
@endif

<div class="form-group col-sm btn-sm">
  <label for="estatus_produccion">{{ __('Estatus producción') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('estatus_produccion', $estatus, ['class' => 'form-control disable', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus producción'), 'readonly' => 'readonly']) !!}
  </div>
</div>