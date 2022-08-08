<label for="redes_sociales">{{ __('DATOS DE FACTURA') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="uso_de_cfdi">{{ __('Uso de CFDI') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
         {!! Form::text('uso_de_cfdi', $factura->uso_de_cfdi, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Uso de CFDI'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="metodo_de_pago">{{ __('Metodo de pago') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
         {!! Form::text('metodo_de_pago', $factura->met_de_pag, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Metodo de pago'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>  
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="forma_de_pago">{{ __('Forma de pago') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
         {!! Form::text('forma_de_pago', $factura->form_de_pag, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Forma de pago'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="banco_cuenta_de_retiro">{{ __('Banco, cuenta de retiro') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
         {!! Form::text('banco_cuenta_de_retiro', $factura->banc_de_cuent_de_retir, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Banco, cuenta de retiro'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>  
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="ultimos_4_digitos_cuenta_de_retiro">{{ __('Últimos 4 dígitos cuenta de retiro') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
         {!! Form::text('ultimos_4_digitos_cuenta_de_retiro', $factura->ulti_cuatro_dig_cuent_de_retir, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Últimos 4 dígitos cuenta de retiro'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="concepto">{{ __('Concepto') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
         {!! Form::text('concepto', $factura->concept, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Concepto'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
</div>