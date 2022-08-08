<div class="form-group col-sm btn-sm">
  <label for="tipo_de_envio">{{ __('Tipo de envío') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::text('tipo_de_envio', $costo_de_envio->tip_env, ['class' => 'form-control', 'placeholder' => __('Tipo de envío'), 'readonly' => 'readonly']) !!}
  </div>
</div>