@switch($armado->estat)
  @case(config('app.pendiente')) <!-- ESTATUS VENTAS -->
    @php 
      $borde = config('app.color_a');
      $estatus = config('app.pendiente');
    @endphp
    @break
  <!-- ESTATUS AlMACÉN -->
  @case(config('app.en_espera_de_compra'))
    @php 
      $borde = config('app.color_m');
      $estatus = config('app.en_produccion');
    @endphp
    @break
  @case(config('app.en_revision_de_productos'))
    @php 
      $borde = config('app.color_m');
      $estatus = config('app.en_produccion');
    @endphp
    @break
  <!-- ESTATUS PRODUCCIÓN -->
  @case(config('app.productos_completos'))
    @php 
      $borde = config('app.color_m');
      $estatus = config('app.en_produccion');
    @endphp
    @break
  @case(config('app.en_produccion'))
    @php 
      $borde = config('app.color_m');
      $estatus = config('app.en_produccion');
    @endphp
    @break
  <!-- ESTATUS ESTATUS LOGÍSTICA -->
  @case(config('app.en_almacen_de_salida'))
    @php 
      $borde = config('app.color_h');
      $estatus = config('app.en_almacen_de_salida');
    @endphp
    @break
  @case(config('app.en_ruta'))
    @php 
      $borde = config('app.color_g');
      $estatus = config('app.en_ruta');
    @endphp
    @break
  @case(config('app.entregado'))
    @php 
      $borde = config('app.color_d'); 
      $estatus = config('app.entregado');
    @endphp
    @break
  @case(config('app.sin_entrega_por_falta_de_informacion'))
    @php 
      $borde = config('app.color_f');
      $estatus = config('app.sin_entrega_por_falta_de_informacion');
    @endphp
    @break
  @case(config('app.intento_de_entrega_fallido'))
    @php 
      $borde = config('app.color_f');
      $estatus = config('app.intento_de_entrega_fallido');
    @endphp
    @break
  @default
    @php 
      $borde = config('app.color_null');
      $estatus = NULL; 
    @endphp
@endswitch

<div class="form-group col-sm btn-sm">
  <label for="estatus">{{ __('Estatus') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('estatus', $estatus, ['class' => 'form-control disabled', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus'), 'readonly' => 'readonly']) !!}
  </div>
</div>