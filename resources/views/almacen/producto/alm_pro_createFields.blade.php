<div class="row">
  <div class="form-group col-sm btn-sm bg-danger">
    <label for="label">{{ __('IMPORTANTE: Revisar si el producto ya existe antes de registrarlo.') }}</label>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="imagen_del_producto">{{ __('Imagen del producto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
     <div class="custom-file"> 
        {!! Form::file('imagen_del_producto', ['id' => 'imagen_del_producto', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_del_producto", "visualizar-imagen_del_producto")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
      <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
    </div>
    <span class="text-danger">{{ $errors->first('imagen_del_producto') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <center>
      <figure>
        <div id="visualizar-imagen_del_producto"></div>
      </figure>
    </center>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_producto">{{ __('Nombre del producto') }} * ({{ __('Incluir Gramos o Mililitros') }})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('nombre_del_producto', null, ['class' => 'form-control' . ($errors->has('nombre_del_producto') ? ' is-invalid' : ''), 'maxlength' => 70, 'placeholder' => __('Nombre del producto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_del_producto') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="es_producto_de_catalogo">{{ __('Es producto de catálogo') }} * ({{ __('Arcones') }})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::select('es_producto_de_catalogo', config('opcionesSelect.select_producto_de_catalogo'), null, ['class' => 'form-control select2' . ($errors->has('es_producto_de_catalogo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('es_producto_de_catalogo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="minimo_de_venta">{{ __('Mínimo de venta') }} ({{ __('Mínimo de piezas que debe comprar el cliente') }})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('minimo_de_venta', null, ['id' => 'minimo_de_venta', 'class' => 'form-control' . ($errors->has('minimo_de_venta') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Mínimo de venta'), 'onChange' => "getDecimal('minimo_de_venta');"]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('minimo_de_venta') }}</span>
  </div>

  <div class="form-group col-sm btn-sm">
    <label for="publicado_en_tienda_gourmet">{{ __('¿Publicado en tienda gourmet?') }} </label>
    <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
        </div>
        {!! Form::select('publicado_en_tienda_gourmet', config('opcionesSelect.select_si_no'), 'No', ['class' => 'form-control select2' . ($errors->has('publicado_en_tienda_gourmet') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('publicado_en_tienda_gourmet') }}</span>
  </div>

</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="marca">{{ __('Marca') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar marca') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::select('marca', $marca_list, null, ['class' => 'form-control select2' . ($errors->has('marca') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('marca') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="tipo">{{ __('Tipo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo', config('opcionesSelect.select_tipo'), null, ['id' => 'tipo', 'class' => 'form-control select2' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'getTipo();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo') }}</span>
  </div>
</div>
<div id="medidas">
  <label for="redes_sociales">{{ __('MEDIDAS') }}</label>
  <div class="border border-primary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="tamano">{{ __('Tamaño') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-text-width"></i></span>
          </div>
          {!! Form::select('tamano', config('opcionesSelect.select_tamano'), null, ['class' => 'form-control select2' . ($errors->has('tamano') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
          </div>
        <span class="text-danger">{{ $errors->first('tamano') }}</span>
      </div>
      <div class="form-group col-sm btn-sm">
        <label for="alto">{{ __('Alto') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
          </div>
          {!! Form::text('alto', null, ['id' => 'alto', 'class' => 'form-control' . ($errors->has('alto') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Alto'), 'onChange' => 'getAlto();']) !!}
          <div class="input-group-prepend">
            <span class="input-group-text">cm</span>
          </div>
        </div>
        <span class="text-danger">{{ $errors->first('alto') }}</span>
      </div>
      <div class="form-group col-sm btn-sm">
        <label for="ancho">{{ __('Ancho') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
          </div>
          {!! Form::text('ancho', null, ['id' => 'ancho', 'class' => 'form-control' . ($errors->has('ancho') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Ancho'), 'onChange' => 'getAncho();']) !!}
          <div class="input-group-prepend">
            <span class="input-group-text">cm</span>
          </div>
        </div>
        <span class="text-danger">{{ $errors->first('ancho') }}</span>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="largo">{{ __('Largo') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
          </div>
          {!! Form::text('largo', null, ['id' => 'largo', 'class' => 'form-control' . ($errors->has('largo') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Largo'), 'onChange' => 'getLargo();']) !!}
          <div class="input-group-prepend">
            <span class="input-group-text">cm</span>
          </div>
        </div>
        <span class="text-danger">{{ $errors->first('largo') }}</span>
      </div>
      <div class="form-group col-sm btn-sm">
        <label for="costo_de_armado">{{ __('Costo de armado') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
          </div>
          {!! Form::text('costo_de_armado', null, ['id' => 'costo_de_armado', 'class' => 'form-control' . ($errors->has('costo_de_armado') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Costo de armado'), 'onChange' => 'getTipo();']) !!}
          <div class="input-group-append">
            <span class="input-group-text">.00</span>
          </div>
        </div>
        <span class="text-danger">{{ $errors->first('costo_de_armado') }}</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="categoria">{{ __('Categoría') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('categoria.create') }}" class="btn btn-light btn-sm   ml-3 p-1" target="_blank">{{ __('Registrar categoría') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
       <select class="form-control select2" aria-label="Default select example" placeholder="selecciona"  name="categoria" required>
        <option placeholder="Seleccione..."></option>
        @foreach ($categorias_list as $categoria )
        <option value="{{ $categoria->id}}">{{ $categoria->categoria}}</option>
        @endforeach
      </select> 
    </div>
    <span class="text-danger">{{ $errors->first('categoria') }}</span>
  </div>
  <div  class="form-group col-sm btn-sm">
    <label>{{ __('SubCategoria') }}</label>
    <div  class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dice"></i></span>
      </div>
        <select class="form-control select2" aria-label="Default select example" placeholder="selecciona"  name="subcategoria">
          <option placeholder="Seleccione..."></option>
          @foreach ($subcat_list as $subcat)
              <option value="{{ $subcat->id }}">{{ $subcat->subcategoria }}</option>
          @endforeach
        </select>
    </div>
  </div>
</div>

<div class="row">
  <div class="form-group col-sm-6 btn-sm">
    <label for="etiqueta">{{ __('Etiqueta') }} </label>
    @can('sistema.catalogo.create')
      <a href="{{ route('etiqueta.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar etiqueta') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>  
      {{--  {!! Form::select('etiqueta[]', $etiquetas_list, null, ['class' => 'form-control select2' . ($errors->has('etiqueta') ? ' is-invalid' : ''), 'multiple']) !!}      --}}

      <select class="form-control select2" aria-label="Default select example" placeholder="selecciona"  name="etiqueta[]" multiple>
        <option placeholder="Seleccione..."></option>
        @foreach ($etiquetas_list as $etiqueta )
        <option value="{{ $etiqueta->id}}">{{ $etiqueta->etiqueta}}</option>
        @endforeach
      </select> 
    </div>
    <span class="text-danger">{{ $errors->first('etiqueta') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="peso">{{ __('Peso') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-weight"></i></span>
      </div>
      {!! Form::text('peso', null, ['id' => 'peso', 'class' => 'form-control' . ($errors->has('peso') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Peso'), 'onChange' => 'getPeso();']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">Kg</i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('peso') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="codigo_de_barras">{{ __('Código de barras') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-barcode"></i></i></span>
      </div>
      {!! Form::text('codigo_de_barras', null, ['class' => 'form-control' . ($errors->has('codigo_de_barras') ? ' is-invalid' : ''), 'maxlength' => 250, 'placeholder' => __('Código de barras')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('codigo_de_barras') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="cantidad_minima_de_stock">{{ __('Cantidad mínima de stock') }} ({{ __('O Cantidad máxima de venta') }})</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></i></span>
      </div>
      {!! Form::text('cantidad_minima_de_stock', null, ['class' => 'form-control' . ($errors->has('cantidad_minima_de_stock') ? ' is-invalid' : ''), 'maxlength' => 5, 'placeholder' => __('Cantidad mínima de stock')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('cantidad_minima_de_stock') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripcion_del_producto">{{ __('Descripción del producto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripcion_del_producto', null, ['class' => 'form-control' . ($errors->has('descripcion_del_producto') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Descripción del producto'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('descripcion_del_producto') }}</span>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@include('almacen.producto.alm_pro_getDecimal')
@section('js4')
<script>
  window.onload = function() { 
    getTipo();
  }
  function getDecimal(id) {
    campo = document.getElementById(id).value;

    if (isNaN(parseFloat(campo))) {
      campo = 0;
    }
    campo_decimal   = Number.parseFloat(campo).toFixed(2);
    document.getElementById(id).value = campo_decimal;
  }
  function getTipo() {
    // Obtiene los valores de los inputs
    selectTipo = document.getElementById("tipo"),
    tipo = selectTipo.value;
    medidas = document.getElementById('medidas');
    // ---

    // Asigna el valor al input costo de armado dependoendo la seleccion del input tipo
    if(tipo == 'Canasta') {
      medidas.style.display = 'block';
      costo_de_armado = document.getElementById("costo_de_armado").value;
      if (isNaN(parseFloat(costo_de_armado))) {
        costo_de_armado = 0;
      }
    } else if(tipo == 'Producto' || tipo == '') {
      medidas.style.display = 'none';
      costo_de_armado = 0;
    }
    // ---
    
    // Agrega o solo deja dos decimales
    costo_de_armado_decimal   = Number.parseFloat(costo_de_armado).toFixed(2);
    // ---
  
    // Pega el resultado en los inputs
    if(tipo == 'Canasta') {
      document.getElementById("costo_de_armado").value = costo_de_armado_decimal;
    }
  }
</script>
@endsection