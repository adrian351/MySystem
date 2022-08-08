<div class="form-group col-sm btn-sm">
  <label for="costo_de_envio">{{ __('Costo de envío') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('costo_de_envio', Sistema::dosDecimales($armado->cost_env), ['id' => 'costo_de_envio', 'class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Costo de envío'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>