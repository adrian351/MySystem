<div class="form-group col-sm btn-sm">
  <label for="product_line">{{ __('Product Line') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
      {!! Form::text('product_line', $material->produc_lin, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Product Line'), 'readonly' => 'readonly']) !!}
  </div>
</div>