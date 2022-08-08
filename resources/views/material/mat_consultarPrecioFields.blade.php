<label for="redes_sociales">{{ __('RESULTADO') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    @include('material.mat_showFields.sku')
    @include('material.mat_showFields.familia_de_producto')
  </div>
  <div class="row">
    @include('material.mat_showFields.descripcion')
  </div>
  <div class="row">
    @include('material.mat_showFields.linea_de_producto')
    @include('material.mat_showFields.sub_linea_de_producto')
  </div>
  <div class="row">
    @include('material.mat_showFields.precio_lista_pagina')
    @include('material.mat_showFields.descuento')
    @include('material.mat_showFields.precio_pagina_al_cliente')
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="descripcion">{{ __('Descripción') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::textarea('descripcion', $material->sku.', '.$material->des.', '.$material->lin_de_prod.', '.$material->sub_lin_de_prod, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Descripción'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
</div>