<div class="form-group col-sm btn-sm">
  <label for="precio_original">{{ __('Precio original') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
      {!! Form::text('precio_original', Sistema::dosDecimales($armado->prec_origin), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Precio original'), 'readonly' => 'readonly']) !!}
  </div>
</div>