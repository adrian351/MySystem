<div class="form-group col-sm btn-sm">
  <label for="total">{{ __('Total') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('total', Sistema::dosDecimales($armado->tot), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Total'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>