<div class="row">
  <div class="form-group col-sm btn-sm">
    <div class="input-group justify-content-center">
      @if($producto->img_prod_rut != null)
        <img src="{{ $producto->img_prod_rut.$producto->img_prod_nom}}" class="profile-user-img img-fluid" alt="{{ $producto->img_prod_nom }}">
      @endif
    </div>
  </div>
</div>
<div id="datos">
  <div class="card">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-info-circle"></i> {{ __('Datos del registro') }}
        </button>
      </h5>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#datos">
      <div class="card-body"> 
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <label for="created_at">{{ __('Fecha de registro') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
              </div>
               {!! Form::text('created_at', $producto->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
            </div>
          </div>
          <div class="form-group col-sm btn-sm">
            <label for="created_at_prod">{{ __('Registrado por') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              {!! Form::text('created_at_prod', $producto->created_at_prod, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <label for="updated_at">{{ __('Fecha última modificación') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
              </div>
               {!! Form::text('updated_at', $producto->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
            </div>
          </div>
          <div class="form-group col-sm btn-sm">
            <label for="updated_at_prod">{{ __('Última modificación por') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              {!! Form::text('updated_at_prod', $producto->updated_at_prod, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_producto">{{ __('Nombre del producto') }} ({{ __('Incluir Gramos o Mililitros') }})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('nombre_del_producto', $producto->produc, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Nombre del producto'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="sku">{{ __('SKU') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
      </div>
      {!! Form::text('sku', $producto->sku, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('SKU'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="habilitar_o_deshabilitar">{{ __('Habilitar o deshabilitar') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-question"></i></span>
      </div>
      {!! Form::select('habilitar_o_deshabilitar', config('opcionesSelect.select_habilitado_deshabilitado'), $producto->hab_desh, ['class' => 'form-control select2', 'placeholder' => __('')]) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="producto_validado">{{ __('¿Producto validado?') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-question"></i></span>
      </div>
      {!! Form::select('producto_validado', config('opcionesSelect.select_si_no'), $producto->prod_valid, ['class' => 'form-control select2', 'placeholder' => __('')]) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="es_producto_de_catalogo">{{ __('Es producto de catálogo') }} ({{ __('Arcones') }})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('es_producto_de_catalogo', $producto->pro_de_cat, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Es producto de catálogo'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="minimo_de_venta">{{ __('Mínimo de venta') }} ({{ __('Mínimo de piezas que debe comprar el cliente') }})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('minimo_de_venta', $producto->min_vent, ['id' => 'minimo_de_venta', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Mínimo de venta'), 'readonly' => 'readonly']) !!}
    </div>
  </div>

  <div class="form-group col-sm btn-sm">
    <label for="publicado_en_tienda_gourmet">{{ __('¿Publicado en tienda gourmet?') }} </label>
    <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
        </div>
        {!! Form::select('publicado_en_tienda_gourmet', config('opcionesSelect.select_si_no'), $producto->publi_tie_gou,['class' => 'form-control select2', 'placeholder' => __('')]) !!}
    </div>
  </div>

</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="marca">{{ __('Marca') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('marca', $producto->marc, ['class' => 'form-control', 'maxlength disable' => 0, 'placeholder' => __('Marca'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="tipo">{{ __('Tipo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo', config('opcionesSelect.select_tipo'), $producto->tip, ['id' => 'tipo', 'class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly', 'onChange' => 'calcularUtilidad();']) !!}
    </div>
  </div>
</div>
<div id="medidas">
  @if($producto->tip == 'Canasta')
    <label for="redes_sociales">{{ __('MEDIDAS') }}</label>
    <div class="border border-primary rounded p-2">
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="tamano">{{ __('Tamaño') }} *</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text-width"></i></span>
            </div>
            {!! Form::select('tamano', config('opcionesSelect.select_tamano'), $producto->tam, ['class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
            </div>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="alto">{{ __('Alto') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
            </div>
            {!! Form::text('alto', Sistema::dosDecimales($producto->alto), ['id' => 'alto', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Alto'), 'readonly' => 'readonly', 'onChange' => 'getAlto();']) !!}
            <div class="input-group-prepend">
              <span class="input-group-text">cm</span>
            </div>
          </div>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="ancho">{{ __('Ancho') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
            </div>
            {!! Form::text('ancho', Sistema::dosDecimales($producto->ancho), ['id' => 'ancho', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Ancho'), 'readonly' => 'readonly', 'onChange' => 'getAncho();']) !!}
            <div class="input-group-prepend">
              <span class="input-group-text">cm</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <label for="largo">{{ __('Largo') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
            </div>
            {!! Form::text('largo', Sistema::dosDecimales($producto->largo), ['id' => 'largo', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Largo'), 'readonly' => 'readonly', 'onChange' => 'getLargo();']) !!}
            <div class="input-group-prepend">
              <span class="input-group-text">cm</span>
            </div>
          </div>
        </div>
        <div class="form-group col-sm btn-sm">
          <label for="costo_de_armado">{{ __('Costo de armado') }}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
            </div>
            {!! Form::text('costo_de_armado', Sistema::dosDecimales($producto->cost_arm), ['id' => 'costo_de_armado', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Costo de armado'), 'readonly' => 'readonly', 'onChange' => 'getCostoDeArmado();']) !!}
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="vendidos">{{ __('Vendidos') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('vendidos', Sistema::dosDecimales($producto->vend), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Vendidos'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="cantidad_vendida">{{ __('Cantidad vendida') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('cantidad_vendida', Sistema::dosDecimales($producto->vend), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Cantidad vendida'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="stock">{{ __('Stock naucalpan') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('stock', Sistema::dosDecimales($producto->stock), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Stock'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="stock">{{ __('Stock temas') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('stock', Sistema::dosDecimales($producto->stock_temas), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Stock'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="existencia_equivalente">{{ __('Existencia equivalente') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('existencia_equivalente', Sistema::dosDecimales($existencia_equivalente), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Existencia equivalente'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>

<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_proveedor">{{ __('Nombre del proveedor') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('nombre_del_proveedor', [$producto->prove => $producto->prove], $producto->prove, ['class' => 'form-control disable select2', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_proveedor">{{ __('Precio proveedor') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_proveedor', Sistema::dosDecimales($producto->prec_prove), ['id' => 'precio_proveedor', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Precio proveedor'), 'readonly' => 'readonly']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('precio_proveedor') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="utilidad">{{ __('Utilidad') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::select('utilidad', config('opcionesSelect.select_utilidad'), $producto->utilid, ['id' => 'utilidad', 'class' => 'form-control disable select2', 'placeholder' => __(''), 'disabled']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_cliente">{{ __('Precio cliente') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_cliente', Sistema::dosDecimales($producto->prec_clien), ['id' => 'precio_cliente', 'class' => 'form-control disabled', 'placeholder' => __('Precio cliente'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="categoria">{{ __('Categoría') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      @if(sizeof($producto->categoria) == 0)
        {!! Form::text('subcategoria', null, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Categoría'), 'readonly' => 'readonly']) !!}
        @else
          @foreach ($producto->categoria as $cat)
            {!! Form::text('categoria', $cat->categoria, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Categoría'), 'readonly' => 'readonly']) !!}
          @endforeach
      @endif
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="categoria">{{ __('SubCategoría') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
        @if(sizeof($producto->subcategoria) == 0)
          {!! Form::text('subcategoria', null, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('SubCategoria'), 'readonly' => 'readonly']) !!}
          @else
            @foreach ($producto->subcategoria as $subCat)  
              {!! Form::text('subcategoria', $subCat->subcategoria, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('SubCategoria'), 'readonly' => 'readonly']) !!}
            @endforeach
        @endif
    </div>
  </div>
</div>
<div class="row">
   <div class="form-group col-sm btn-sm">
      <label for="categoria">{{ __('Etiqueta (s)') }}</label>
      <div id="etiqueta">
        <div class="card">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <i class="fas fa-arrow-right"></i> Lista
              </button>
            </h5>
         
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#etiqueta">  
            <div class="card-body">
              @foreach ($producto->etiqueta as $e)
                <span>{{ $e->etiqueta. " | " }}</span>
              @endforeach
            </div>
          </div>
        </div>
      </div>
  </div>  
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="peso">{{ __('Peso') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-weight"></i></span>
      </div>
      {!! Form::text('peso', Sistema::tresDecimales($producto->pes), ['id' => 'peso', 'class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Peso'), 'readonly' => 'readonly']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">Kg</i></span>
      </div>
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="frecuencia">{{ __('Frecuencia') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('frecuencia', Sistema::dosDecimales($producto->armados()->count()), ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Frecuencia'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="codigo_de_barras">{{ __('Código de barras') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-barcode"></i></i></span>
      </div>
      {!! Form::text('codigo_de_barras', $producto->cod_barras, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Código de barras'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="cantidad_minima_de_stock">{{ __('Cantidad mínima de stock') }} ({{ __('O Cantidad máxima de venta')}})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('cantidad_minima_de_stock', $producto->min_stock, ['class' => 'form-control disable', 'maxlength' => 5, 'placeholder' => __('Cantidad mínima de stock'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
@if($producto->desc_del_pro != null)
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripcion_del_producto">{{ __('Descripción del producto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripcion_del_producto', $producto->desc_del_prod, ['class' => 'form-control disable', 'maxlength' => 00, 'placeholder' => __('Descripción del producto'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
@endif
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('almacen.producto.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@include('almacen.producto.alm_pro_calcularUtilidad')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection