@if(Request::route()->getName() == 'venta.pedidoActivo.edit')
<br>
  {!! Form::open(['route' => ['venta.pedidoActivo.archivo.store', Crypt::encrypt($pedido->id)], 'onsubmit' => 'return checarBotonSubmit("btnVentaPedidoActivoArchivoStore")', 'files' => true]) !!}
    <div class="form-group row p-0 m-0">
      <div class="col-sm">
        <div class="input-group">
          {!! Form::text('nombre', null, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),  'maxlength' => 40, 'placeholder' => __('Nombre')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('nombre') }}</span>
      </div>
      <div class="col-sm">
        <div class="input-group-append">
          <div class="custom-file"> 
            {!! Form::file('archivos[]', ['class' => 'custom-file-input' . ($errors->has('archivos.*') ? ' is-invalid' : ''), 'lang' => Auth::user()->lang, 'multiple']) !!}
            <label class="custom-file-label" for="archivo">Max. 1MB</label>
          </div>
          &nbsp&nbsp&nbsp<button type="submit" id="btnVentaPedidoActivoArchivoStore" class="btn btn-info rounded" title="{{ __('Cargar') }}"><i class="fas fa-check-circle text-dark"></i></button>
        </div>
        <span class="text-danger">{{ $errors->first('archivos.*') }}</span>
      </div>
    </div>
  {!! Form::close() !!}
@endif