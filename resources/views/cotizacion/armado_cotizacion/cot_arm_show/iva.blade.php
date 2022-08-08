<div class="form-group col-sm btn-sm">
  <label for="iva">{{ __('IVA') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('iva', Sistema::dosDecimales($armado->iva), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('IVA'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>