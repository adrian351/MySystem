<div class="form-group col-sm btn-sm">
  <label for="tamano">{{ __('Tamaño') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::text('tamano', $costo_de_envio->tam, ['class' => 'form-control', 'placeholder' => __('Tamaño'), 'readonly' => 'readonly']) !!}
  </div>
</div>