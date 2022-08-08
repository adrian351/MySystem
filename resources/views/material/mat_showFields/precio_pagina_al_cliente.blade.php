<div class="form-group col-sm btn-sm">
  <label for="precio_pagina_al_cliente">{{ __('Precio Pagina (Al cliente)') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('precio_pagina_al_cliente', $material->prec_pag_al_cli, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Precio Pagina (Al cliente)'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>