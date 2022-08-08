<div class="form-group col-sm btn-sm">
  <label for="descuento">{{ __('Descuento') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('descuento', $material->desc, ['id' => 'descuento', 'class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Descuento'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>