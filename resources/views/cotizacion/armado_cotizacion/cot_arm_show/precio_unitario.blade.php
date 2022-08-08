<div class="form-group col-sm btn-sm">
  <label for="precio_unitario">{{ __('Precio unitario') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('precio_unitario', Sistema::dosDecimales($armado->prec_redond), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Precio unitario'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>