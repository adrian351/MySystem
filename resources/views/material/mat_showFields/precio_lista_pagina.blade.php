<div class="form-group col-sm btn-sm">
  <label for="precio_lista_pagina">{{ __('Precio Lista Pagina') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    {!! Form::text('precio_lista_pagina', $material->prec_list_pag, ['id' => 'precio_lista_pagina', 'class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Precio Lista Pagina'), 'readonly' => 'readonly']) !!}
    <div class="input-group-append">
      <span class="input-group-text">.00</span>
    </div>
  </div>
</div>