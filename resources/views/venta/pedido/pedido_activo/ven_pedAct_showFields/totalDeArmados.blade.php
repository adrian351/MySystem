<div class="form-group col-sm btn-sm">
  <label for="total_de_armados">{{ __('Total de armados') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('total_de_armados', Sistema::dosDecimales($pedido->arm_carg) . ' de ' . Sistema::dosDecimales($pedido->tot_de_arm), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Total de armados'), 'readonly' => 'readonly']) !!}
  </div>
</div>