<div class="form-group col-sm btn-sm">
  <label for="codigo_de_facturacion">{{ __('Código de facturación') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
     {!! Form::text('codigo_de_facturacion', $pago->cod_fact, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Código de facturación'), 'readonly' => 'readonly']) !!}
  </div>
</div>