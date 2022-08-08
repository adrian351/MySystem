<div class="form-group col-sm btn-sm">
  <label for="costo_de_caja">{{ __('Costo de caja') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('costo_de_caja', $costo_de_envio->cost_tam_caj, ['id' => 'costo_de_caja', 'class' => 'form-control disabled', 'placeholder' => __('Costo de caja'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>