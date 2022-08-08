<div class="form-group col-sm btn-sm">
  <label for="costo_por_envio">{{ __('Costo por envío') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('costo_por_envio', $costo_de_envio->cost_por_env, ['id' => 'costo_por_envio', 'class' => 'form-control disabled', 'placeholder' => __('Costo por envío'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>