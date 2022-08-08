<div class="form-group col-sm btn-sm">
  <label for="numeor_de_pedido_generado">{{ __('Núm. pedido generado') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('numeor_de_pedido_generado', $cotizacion->num_pedido_gen, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Núm. pedido generado'), 'readonly' => 'readonly']) !!}
  </div>
</div>