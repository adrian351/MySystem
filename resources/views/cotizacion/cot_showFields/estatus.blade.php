@switch($cotizacion->estat)
  @case(config('app.abierta'))
    @php $borde = config('app.color_a'); @endphp
    @break
  @case(config('app.aprobada'))
    @php $borde = config('app.color_d'); @endphp
    @break
  @case(config('app.cancelada'))
    @php $borde = config('app.color_c'); @endphp
    @break
  @default
    {{ $cotizacion->estat }}
@endswitch

<div class="form-group col-sm btn-sm">
  <label for="estatus">{{ __('Estatus') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('estatus', $cotizacion->estat, ['class' => 'form-control disable', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Estatus'), 'readonly' => 'readonly']) !!}
  </div>
</div>