<div class="form-group col-sm btn-sm">
  <label for="codigo">{{ __('Código') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('codigo', $armado->cod, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Código'), 'readonly' => 'readonly']) !!}
  </div>
</div>