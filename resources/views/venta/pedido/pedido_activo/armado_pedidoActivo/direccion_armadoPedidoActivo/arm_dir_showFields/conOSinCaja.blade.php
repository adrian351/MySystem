<div class="form-group col-sm btn-sm">
  <label for="tipo_de_caja">{{ __('Tipo de caja') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
      {!! Form::text('tipo_de_caja', $direccion->caj, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Tipo de caja'), 'readonly' => 'readonly']) !!}
  </div>
</div>