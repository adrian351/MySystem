<div class="form-group col-sm btn-sm">
    <label for="municipio">{{ __('Municipio') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::text('municipio', $costo_de_envio->mun, ['class' => 'form-control', 'placeholder' => __('Municipio'), 'readonly' => 'readonly']) !!}
    </div>
  </div>