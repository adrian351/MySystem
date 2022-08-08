<div class="form-group col-sm btn-sm">
  <label for="precio_de_compra">{{ __('Precio de compra') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
      {!! Form::text('precio_de_compra', Sistema::dosDecimales($armado->prec_de_comp), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Precio de compra'), 'readonly' => 'readonly']) !!}
  </div>
</div>