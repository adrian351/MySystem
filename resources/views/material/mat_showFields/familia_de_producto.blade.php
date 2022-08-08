<div class="form-group col-sm btn-sm">
  <label for="familia_de_producto">{{ __('Familia de producto') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
      {!! Form::text('familia_de_producto', $material->fam_de_prod, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Familia de producto'), 'readonly' => 'readonly']) !!}
  </div>
</div>