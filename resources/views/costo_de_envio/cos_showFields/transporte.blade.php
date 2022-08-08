<div class="form-group col-sm btn-sm">
  <label for="transporte">{{ __('Transporte') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('transporte', $costo_de_envio->trans, ['id' => 'transporte', 'class' => 'form-control disabled', 'placeholder' => __('Transporte'), 'readonly' => 'readonly']) !!}
  </div>
</div>