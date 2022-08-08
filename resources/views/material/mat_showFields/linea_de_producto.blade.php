<div class="form-group col-sm btn-sm">
  <label for="linea_de_producto">{{ __('Línea de producto') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
      {!! Form::text('linea_de_producto', $material->lin_de_prod, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Línea de producto'), 'readonly' => 'readonly']) !!}
  </div>
</div>