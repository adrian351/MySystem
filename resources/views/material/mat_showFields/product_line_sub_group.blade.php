<div class="form-group col-sm btn-sm">
  <label for="product_line_sub_group">{{ __('Product Line Sub-Group') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
      {!! Form::text('product_line_sub_group', $material->produc_lin_sub_gro, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Product Line Sub-Group'), 'readonly' => 'readonly']) !!}
  </div>
</div>