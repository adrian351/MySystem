<div class="form-group col-sm btn-sm">
  <label for="ubicacion_rack">{{ __('Ubicación rack') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('ubicacion_rack', $armado->ubic_rack, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ubicación rack'), 'readonly' => 'readonly']) !!}
  </div>
</div>