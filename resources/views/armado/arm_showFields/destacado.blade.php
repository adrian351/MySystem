<div class="form-group col-sm btn-sm">
  <label for="destacado">{{ __('Destacado') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-star"></i></span>
    </div>
    {!! Form::select('destacado', config('opcionesSelect.select_destacado'), $armado->dest, ['class' => 'form-control disabled select2', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
    </div>
</div>