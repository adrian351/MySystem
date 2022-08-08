<div class="form-group col-sm btn-sm">
  <label for="monto_de_pago">{{ __('Monto de pago') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('monto_de_pago', Sistema::dosDecimales($pago->mont_de_pag), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Monto de pago'), 'readonly' => 'readonly']) !!}
  </div>
</div>