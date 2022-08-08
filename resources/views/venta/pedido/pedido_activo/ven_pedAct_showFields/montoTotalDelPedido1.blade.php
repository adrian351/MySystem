<div class="form-group col-sm btn-sm">
    <label for="monto_total_del_pedido">{{ __('Monto total del pedido') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('monto_total_del_pedido', Sistema::dosDecimales($pedido->mont_tot_de_ped), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Monto total del pedido'), 'readonly' => 'readonly']) !!}
    </div>
  </div>