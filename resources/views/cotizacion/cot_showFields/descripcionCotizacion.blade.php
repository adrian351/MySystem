@if($cotizacion->desc_cot != 'Sin descripcion' && $cotizacion->desc_cot != '')
<div class="form-group col-sm btn-sm">
  <label for="describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla">{{ __('Describe esta cotización para que sea mas fácil encontrarla') }} </label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::textarea('describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla', $cotizacion->desc_cot, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Describe esta cotización para que sea mas fácil encontrarla'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
  </div>
</div>
@endif