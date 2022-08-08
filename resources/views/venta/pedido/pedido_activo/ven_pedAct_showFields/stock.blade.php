<div class="form-group col-sm btn-sm">
  <label for="es_pedido_de_stock">{{ __('¿Es pedido de STOCK?') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-question"></i></span>
    </div>
    {!! Form::select('es_pedido_de_stock', config('opcionesSelect.select_se_puede_entregar_antes'), $pedido->stock, ['id' => 'es_pedido_de_stock', 'class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly', 'disabled']) !!}
  </div>
</div>