<div class="form-group col-sm btn-sm">
  <label for="serie">{{ __('Serie') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::text('serie', $cotizacion->serie, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Serie'), 'readonly' => 'readonly']) !!}
  </div>
</div>