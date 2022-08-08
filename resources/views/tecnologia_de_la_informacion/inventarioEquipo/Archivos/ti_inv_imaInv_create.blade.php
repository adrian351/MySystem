@if(Request::route()->getName() == 'inventario.edit')
  {!! Form::open(['route' => ['inventario.archivo.store', Crypt::encrypt($inventario->id)], 'onsubmit' => 'return checarBotonSubmit("btnInventarioImagenesStore")', 'class' => 'col-sm-6 float-right', 'files' => true]) !!}
    <div class="form-group row p-0 m-0">
      <label for="imagenes" class="col-sm-4 col-form-label">{{ __('Cargar imágenes') }} *</label>
      <div class="col-sm-8">
        <div class="input-group-append">
          <div class="custom-file"> 
            {!! Form::file('imagenes[]', ['class' => 'custom-file-input' . ($errors->has('imagenes.*') ? ' is-invalid' : ''), 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang, 'multiple']) !!}
            <label class="custom-file-label" for="archivo">Max. 1MB</label>
          </div>
          &nbsp&nbsp&nbsp<button type="submit" id="btnInventarioImagenesStore" class="btn btn-info rounded" title="{{ __('Cargar') }}"><i class="fas fa-check-circle text-dark"></i></button>
          </div>
        <span class="text-danger">{{ $errors->first('imagenes.*') }}</span>
      </div>
    </div>
  {!! Form::close() !!}
@endif