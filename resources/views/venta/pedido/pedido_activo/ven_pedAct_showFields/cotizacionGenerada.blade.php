<div class="form-group col-sm btn-sm">
  <label for="cotizacion">{{ __('Cotización') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('cotizacion', $pedido->cot_gen, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Cotización'), 'readonly' => 'readonly']) !!}
  </div>
</div>