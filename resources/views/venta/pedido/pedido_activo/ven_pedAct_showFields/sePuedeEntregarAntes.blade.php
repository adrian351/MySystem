@if ($pedido->se_pued_entreg_ant != null)
  <div class="form-group col-sm btn-sm">
    <label for="se_puede_entregar_antes">{{ __('¿Se puede entregar antes?') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-question"></i></span>
      </div>
      {!! Form::select('se_puede_entregar_antes', config('opcionesSelect.select_se_puede_entregar_antes'), $pedido->se_pued_entreg_ant, ['class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly', 'disabled']) !!}
    </div>
  </div>
@endif