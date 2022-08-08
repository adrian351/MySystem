<div class="form-group col-sm btn-sm">
  <label for="descuento_especial">{{ __('Descuento especial') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('descuento_especial', $armado->desc_esp, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Descuento especial'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>