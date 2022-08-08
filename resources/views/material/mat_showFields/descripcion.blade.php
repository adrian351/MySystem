<div class="form-group col-sm btn-sm">
  <label for="descripcion_en_ingles">{{ __('Descripción en ingles') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::textarea('descripcion_en_ingles', $material->des, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Descripción en ingles'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
  </div>
</div>