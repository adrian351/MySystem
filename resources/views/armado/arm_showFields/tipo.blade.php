<div class="form-group col-sm btn-sm">
  <label for="tipo">{{ __('Tipo') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('tipo', $armado->tip, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Tipo'), 'readonly' => 'readonly']) !!}
  </div>
</div>