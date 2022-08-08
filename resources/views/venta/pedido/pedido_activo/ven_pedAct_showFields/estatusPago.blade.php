@switch($pedido->estat_pag)
  @case(config('app.pendiente'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.pago_pendiente_de_aprobar'))
   @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.pago_rechazado'))
    @php $borde = config('app.color_c'); @endphp
    @break
  @case(config('app.pagado'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @case(config('app.pagado_eliminados'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @case(config('app.pagoseliminados'))
    @php $borde = config('app.color_c'); @endphp  
    @break
  @default
    @php $borde = config('app.color_null'); @endphp
@endswitch

<div class="form-group col-sm btn-sm">
  <label for="estatus_pago">{{ __('Estatus pago') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('estatus_pago', $pedido->estat_pag, ['class' => 'form-control disable', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus pago'), 'readonly' => 'readonly']) !!}
  </div>
</div>