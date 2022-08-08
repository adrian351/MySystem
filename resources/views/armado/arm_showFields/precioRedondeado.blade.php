<div class="form-group col-sm btn-sm">
  <label for="precio_redondeado">{{ __('Precio redondeado') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
      {!! Form::text('precio_redondeado', Sistema::dosDecimales($armado->prec_redond), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Precio redondeado'), 'readonly' => 'readonly']) !!}
  </div>
</div>