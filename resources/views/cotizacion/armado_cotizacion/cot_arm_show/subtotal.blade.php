<div class="form-group col-sm btn-sm">
  <label for="subtotal">{{ __('Subtotal') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('subtotal', Sistema::dosDecimales($armado->sub_total), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Subtotal'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>