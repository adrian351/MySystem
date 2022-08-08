<div class="form-group col-sm btn-sm">
    <label for="stock_armado">{{ __('Stock') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('stock_armado', $armado->stock , ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Stock'), 'readonly' => 'readonly']) !!}
    </div>
  </div>