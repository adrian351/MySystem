<div class="form-group col-sm btn-sm">
  <label for="cantidad">{{ __('Cantidad') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('cantidad', Sistema::dosDecimales($armado->cant), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Cantidad'), 'readonly' => 'readonly']) !!}
  </div>
</div>