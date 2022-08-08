<div class="form-group col-sm btn-sm">
  <label for="estatus">{{ __('Estatus') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-question"></i></span>
    </div>
    {!! Form::select('estatus', config('opcionesSelect.select_abierto_cerrado'), $pedido->est, ['class' => 'form-control select2 disabled', 'placeholder' => __(''), 'readonly' => 'readonly', 'disabled']) !!}
  </div>
</div>