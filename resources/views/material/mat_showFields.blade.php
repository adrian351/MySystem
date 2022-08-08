@include('material.mat_showFields.created')
<div class="row">
  @include('material.mat_showFields.sku')
</div>
<div class="row">
  @include('material.mat_showFields.descripcion')
</div>
<div class="row">
  @include('material.mat_showFields.lob')
  @include('material.mat_showFields.product_line')
</div>
<div class="row">
  @include('material.mat_showFields.product_line_sub_group')
  @include('material.mat_showFields.familia_de_producto')
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
    <center><a href="{{ route('material.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>