<div class="form-group col-sm btn-sm">
  <label for="es_de_regalo">{{ __('¿Es de regalo?') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::select('es_de_regalo', config('opcionesSelect.select_si_no'), $armado->es_de_regalo, ['class' => 'form-control select2 disabled', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
  </div>
</div>