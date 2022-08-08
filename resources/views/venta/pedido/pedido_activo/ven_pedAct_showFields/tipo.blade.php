@if ($pedido->tip != null)
  <div class="form-group col-sm btn-sm">
    <label for="tipo">{{ __('Tipo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-question"></i></span>
      </div>
      {!! Form::select('tipo', config('opcionesSelect.select_com_o_recl'), $pedido->tip, ['class' => 'form-control select2 disabled', 'placeholder' => __(''), 'readonly' => 'readonly', 'disabled']) !!}
    </div>
  </div>
@endif