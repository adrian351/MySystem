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
      {!! Form::select('tipo', $tipo_list, null, ['class' => 'form-control select2' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo') }}</span>
  </div> --}}

  {{ Form::hidden('tipo', 'Arcón') }}

  <div class="form-group col-sm btn-sm">
    <label for="nombre">{{ __('Nombre') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-shopping-basket"></i></span>
      </div>
        {!! Form::text('nombre', null, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Nombre')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="sku">{{ __('SKU') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('sku', null, ['class' => 'form-control' . ($errors->has('sku') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('SKU')]) !!}
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
      {!! Form::select('gama', $gamas_list, null, ['class' => 'form-control select2' . ($errors->has('gama') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      </div>
    <span class="text-danger">{{ $errors->first('gama') }}</span>
  </div>
</div>

<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="destacado">{{ __('Destacado') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-star"></i></span>
      </div>
      {!! Form::select('destacado', config('opcionesSelect.select_destacado'), 'No',['class' => 'form-control select2' . ($errors->has('destacado') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('destacado') }}</span>
  </div>

  {{--  ¿ Es producto de catalogo ?  --}}
  {{--  @if (Auth::check() && Auth::user()->can('armado.catalogo.select'))  --}}
  @can('armado.catalogo.select')
    <div class="form-group col-sm btn-sm">
      <label for="armado_de_catalogo">{{ __('¿Es armado de catálogo?') }} *</label>&nbsp;
      <label class="text-danger">{{ __('No editar campo sin autorización') }}</label> 
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-toolbox"></i></i></span>
        </div>
          <select  class="form-control select" aria-label="Default select example" placeholder="selecciona" name="arm_de_cat" >
            <option value="No">No</option>
            <option value="Si">Si</option>
          </select>

        @else
          <div class="form-group col-sm btn-sm">
          </div>
  @endcan
  {{--  @endif  --}}
      </div>
        <span class="text-danger">{{ $errors->first('armado_de_catalogo') }}</span>
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
      <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1 p-2" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
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
 {{--  inicio marca   --}}
  
  <div class="form-group col-sm btn-sm"> 
    <label for="marca">{{ __('Marca') }} </label>&nbsp;&nbsp;
    <label class="text-danger">{{ __('No añadir sin autorización') }}</label> 
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tag"></i></span>
      </div>

         {{-- multiselect de marca en armados --}}
      <select class="form-control select2" aria-label="Default select example" placeholder="selecciona" multiple="multiple" name="marca[]">
        @foreach ($marcas_list as $marca )
        <option value="{{ $marca->id }}">{{ $marca->marca}}</option>
        @endforeach
      </select>
    
    </div>
    <span class="text-danger">{{ $errors->first('marca') }}</span>
  </div>
</div> 
{{--  fin  marca--}}

<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="url_pagina">{{ __('URL página') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-link"></i></span>
      </div>
        {!! Form::text('url_pagina', null, ['class' => 'form-control' . ($errors->has('url_pagina') ? ' is-invalid' : ''), 'maxlength' => 150, 'placeholder' => __('URL página')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('url_pagina') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="observaciones">{{ __('Observaciones') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('observaciones', null, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Observaciones'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('observaciones') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('armado.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')