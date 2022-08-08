<div class="row">
  <div class="form-group col-sm btn-sm">
    <div class="input-group justify-content-center">
      @if($armado->img_nom != null)
        <img src="{{ $armado->img_rut.$armado->img_nom }}" class="profile-user-img img-fluid" alt="{{ $armado->img_nom }}">
      @endif
    </div>
  </div>
</div>
<div class="row">

  {{-- <div class="form-group col-sm btn-sm">
    <label for="tipo">{{ __('Tipo') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar tipo') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo', $tipo_list, $armado->tip, ['class' => 'form-control select2' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo') }}</span>
  </div> --}}

  {{ Form::hidden('tipo', 'Arcón') }}

  <div class="form-group col-sm-6 btn-sm">
    <label for="nombre">{{ __('Nombre') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-shopping-basket"></i></span>
      </div>
        {!! Form::text('nombre', $armado->nom, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Nombre')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre') }}</span>
  </div>
  <div class="form-group col-sm-2 btn-sm">
    <label for="operacion" >{{ __('Operación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort"></i></span>
      </div>
      <select name="operacion" id="operacion" class="form-control select2" aria-label="Default select example" >
        <option selected disabled placeholder="Seleccione"></option>
        <option value="sumar" >Sumar</option>
        <option value="restar">Restar</option>
      </select>
    </div>
    <span class="text-danger">{{ $errors->first('operacion') }}</span>
  </div>
  <div class="form-group col-sm-2 btn-sm">
    <label for="stock_armado" >{{ __('Aumentar stock') }}</label>
    <div class="input-group">
      {!! Form::text('stock_armado', null, ['class' => 'form-control' . ($errors->has('stock_armado') ? ' is-invalid' : ''), 'min' => 0, 'placeholder' => __('Cantidad')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('stock_armado') }}</span>
  </div>
  <div class="form-group col-sm-2 btn-sm">
    <label for="stock_actual" >{{ __('Stock actual') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
      </div>
      {!! Form::text('stock_actual', $armado->stock, ['class' => 'form-control', 'placeholder' => __('Stock actual'), 'readonly'  => 'readonly']) !!}
    </div>
  </div>
</div>

<div class="row">
  <div class="form-group col-sm btn-sm"> 
    <label for="sku">{{ __('SKU') }} </label>
    <div class="input-group">      
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('sku', $armado->sku , ['class' => 'form-control' . ($errors->has('sku') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('SKU'), 'readonly' => 'readonly']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('sku') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="gama">{{ __('Gama') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar gama') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-level-up-alt"></i></span>
      </div>
      {!! Form::select('gama', $gamas_list, $armado->gama, ['class' => 'form-control select2' . ($errors->has('gama') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('gama') }}</span>
  </div>
</div>
{{--  nuevo SKU armado, no editable  --}}
<div class="row">
  <div class="form-group col-sm btn-sm"> 
    <label for="sku_armado">{{ __('SKU-ID') }} </label>
    <div class="input-group">      
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <input type="text" class="form-control" disabled value="AC-{{ $armado->id }}">
    </div>
    <span class="text-danger">{{ $errors->first('sku_armado') }}</span>
  </div>

  {{--  ¿ Es producto de catalogo ?  --}}
    <div class="form-group col-sm btn-sm">
      <label for="armado_de_catalogo">{{ __('¿Es armado de catálogo?') }} *</label> &nbsp;
      <label class="text-danger">{{ __('No editar campo sin autorización') }}</label> 
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
        </div>
        @can('armado.catalogo.select')
          <select  class="form-control select" aria-label="Default select example" placeholder="selecciona" name="arm_de_cat">
            @if ( $armado->arm_de_cat == 'No')
                  <option value="No" selected>{{ $armado->arm_de_cat}}</option>
                  <option value="Si">Si</option>
              @else
                <option value="No">No</option>
                <option value="Si" selected>Si</option>
            @endif
          </select>
          @else
            {!! Form::text('arm_de_cat', $armado->arm_de_cat, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        @endcan 
      </div>
        <span class="text-danger">{{ $errors->first('armado_de_catalogo') }}</span>
    </div>
</div>

<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="destacado">{{ __('Destacado') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-star"></i></span>
      </div>
      {!! Form::select('destacado', config('opcionesSelect.select_destacado'), $armado->dest, ['class' => 'form-control select2' . ($errors->has('destacado') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('destacado') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="url_pagina">{{ __('URL producto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-link"></i></span>
      </div>
        {!! Form::text('url_pagina', $armado->url_pagina, ['class' => 'form-control' . ($errors->has('url_pagina') ? ' is-invalid' : ''), 'maxlength' => 150, 'placeholder' => __('URL producto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('url_pagina') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="imagen_del_armado">{{ __('Imagen del armado') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('imagen_del_armado', ['id' => 'imagen_del_armado', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_del_armado", "visualizar-imagen_del_armado")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
      <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
    </div>
    <span class="text-danger">{{ $errors->first('imagen_del_armado') }}</span>

    <div class="form-group col-sm btn-sm">
      <center>
        <figure>
          <div id="visualizar-imagen_del_armado"></div>
        </figure>
      </center>
    </div>
  </div>
  
  <div class="form-group col-sm btn-sm">
    <label for="marca">{{ __('Marca') }} </label>&nbsp;&nbsp;
    <label class="text-danger">{{ __('No añadir sin autorización') }}</label> 

    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tag"></i></span>
      </div>
        {{--  slect marca en armados  --}}
      <select class="form-control select2" aria-label="Default select example" placeholder="selecciona" multiple="multiple" name="marca[]">
        @for ($i = 0; $i <count($marcas_list); $i++)
          {{ $encontrado ="false" }}
            @for ($a = 0; $a <count($armado->marca); $a++)
              @if($marcas_list[$i]->id==$armado->marca[$a]->id)
                {{ $encontrado="true" }}
              @endif 
            @endfor
        {{-- mostrar marcas "selected" y marcas disponibles --}}
          @if($encontrado=="true")    
            <option value="{{ $marcas_list[$i]->id }}" selected>{{ $marcas_list[$i]->marca}}</option>
              @else
                <option value="{{ $marcas_list[$i]->id }}" >{{ $marcas_list[$i]->marca}} </option>
          @endif 
        @endfor
      </select>
    </div>
    <span class="text-danger">{{ $errors->first('marca') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="precio_de_compra">{{ __('Precio de compra') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
        {!! Form::text('precio_de_compra', Sistema::dosDecimales($armado->prec_de_comp), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Precio de compra'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="descuento_especial">{{ __('Descuento especial') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('descuento_especial', $armado->desc_esp, ['id' => 'descuento_especial', 'class' => 'form-control' . ($errors->has('descuento_especial') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Descuento especial'), 'onChange' => 'dosDecimales();']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('descuento_especial') }}</span>  
  </div>
</div>
@section('js6')
<script>
  function dosDecimales() {
    // Obtiene los valores de los inputs
    descuento_especial = document.getElementById("descuento_especial").value;

    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(descuento_especial))) {
      descuento_especial = 0;
    }

    // Agrega o solo deja dos decimales 
    descuento_especial_decimal  = Number.parseFloat(descuento_especial).toFixed(2);

    // Pega el resultado en los inputs
   // document.getElementById("descuento_especial").value = descuento_especial_decimal;
  }
</script>
@endsection
<div class="row">
  @include('armado.arm_showFields.precioOriginal')
  @include('armado.arm_showFields.precioRedondeado')
</div>

@include('armado.arm_showFields.medidas')
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="observaciones">{{ __('Observaciones') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('observaciones', $armado->obs, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Observaciones'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('observaciones') }}</span>
  </div>
</div>
