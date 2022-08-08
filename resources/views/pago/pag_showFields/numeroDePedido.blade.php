<div class="form-group col-sm btn-sm">
  <label for="numero_de_pedido">{{ __('Número de pedido') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('numero_de_pedido', $pedido->num_pedido, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Número de pedido'), 'readonly' => 'readonly']) !!}
  </div>
</div>