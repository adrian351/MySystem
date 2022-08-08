<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="sku">{{ __('SKU') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('sku', $material->sku, ['class' => 'form-control' . ($errors->has('sku') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('SKU')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('sku') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripcion_en_ingles">{{ __('Descripción en ingles') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripcion_en_ingles', $material->des, ['class' => 'form-control' . ($errors->has('descripcion_en_ingles') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Descripción en ingles'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('descripcion_en_ingles') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="lob">{{ __('Lob') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('lob', $material->lob, ['class' => 'form-control' . ($errors->has('lob') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('Lob')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('lob') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="product_line">{{ __('Product Line') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('product_line', $material->produc_lin, ['class' => 'form-control' . ($errors->has('product_line') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Product Line')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('product_line') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="product_line_sub_group">{{ __('Product Line Sub-Group') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('product_line_sub_group', $material->produc_lin_sub_gro, ['class' => 'form-control' . ($errors->has('product_line_sub_group') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Product Line Sub-Group')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('product_line_sub_group') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="familia_de_producto">{{ __('Familia de producto') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('familia_de_producto', $material->fam_de_prod, ['class' => 'form-control' . ($errors->has('familia_de_producto') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Familia de producto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('familia_de_producto') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="linea_de_producto">{{ __('Línea de producto') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('linea_de_producto', $material->lin_de_prod, ['class' => 'form-control' . ($errors->has('linea_de_producto') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Línea de producto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('linea_de_producto') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="sub_linea_de_producto">{{ __('Sub Línea de producto') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('sub_linea_de_producto', $material->sub_lin_de_prod, ['class' => 'form-control' . ($errors->has('sub_linea_de_producto') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Sub Línea de producto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('sub_linea_de_producto') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="precio_lista_pagina">{{ __('Precio Lista Pagina') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_lista_pagina', $material->prec_list_pag, ['id' => 'precio_lista_pagina', 'class' => 'form-control' . ($errors->has('precio_lista_pagina') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Precio Lista Pagina'), 'onChange' => 'getDecimales("precio_lista_pagina");']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('precio_lista_pagina') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="descuento">{{ __('Descuento') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('descuento', $material->desc, ['id' => 'descuento', 'class' => 'form-control' . ($errors->has('descuento') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Descuento'), 'onChange' => 'getDecimales("descuento");']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('descuento') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="precio_pagina_al_cliente">{{ __('Precio Pagina (Al cliente)') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_pagina_al_cliente', $material->prec_pag_al_cli, ['id' => 'precio_pagina_al_cliente', 'class' => 'form-control' . ($errors->has('precio_pagina_al_cliente') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Precio Pagina (Al cliente)'), 'onChange' => 'getDecimales("precio_pagina_al_cliente");']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('precio_pagina_al_cliente') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('material.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'materialUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>

@section('js6')
<script>
  function getDecimales(id) {
    // Obtiene los valores de los inputs
    input = document.getElementById(id).value;

    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(input))) {
      input = 0;
    }

    // Agrega o solo deja dos decimales
    input_decimal  = Number.parseFloat(input).toFixed(2);
   
    document.getElementById(id).value = input_decimal;;
  }
</script>
@endsection