@if($cotizacion->valid >= date("Y-m-d")) 
  @php $borde = config('app.color_g'); @endphp
@else
  @php $borde = config('app.color_c'); @endphp
@endif

<div class="form-group col-sm btn-sm">
  <label for="validez">{{ __('Validez') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" style="border-color:{{ $borde }}"><i class="fas fa-calendar-alt"></i></span>
    </div>
    {!! Form::date('validez', $cotizacion->valid, ['class' => 'form-control disabled', 'style' => "border-color:$borde", 'maxlength' => 0, 'placeholder' => __('Validez'), 'readonly' => 'readonly']) !!}
  </div>
</div>