@can('almacen.producto.sustituto.create')
  @if(Request::route()->getName() == 'almacen.producto.edit')
    {!! Form::open(['route' => ['almacen.producto.sustituto.store', Crypt::encrypt($producto->id)], 'onsubmit' => 'return checarBotonSubmit("btnAlmacenProductoSustitutoStore")', 'class' => 'col-sm-6 float-right']) !!}
      <div class="form-group row p-0 m-0">
        <label for="sustitutos" class="col-sm-3 col-form-label">{{ __('Registrar sustitutos') }} *</label>
        <div class="col-sm-9">
          <div class="input-group-append">
            {!! Form::select('ids_sustituto[]', $sustitutos_list, null, ['class' => 'form-control form-control-sm w-100 select2' . ($errors->has('ids_sustituto') ? ' is-invalid' : ''), 'multiple']) !!}
            &nbsp&nbsp&nbsp<button type="submit"  id="btnAlmacenProductoSustitutoStore" class="btn btn-info rounded" title="{{ __('Registrar') }}"><i class="fas fa-check-circle text-dark"></i></button>
          </div>
          <span class="text-danger">{{ $errors->first('ids_sustituto') }}</span>
        </div>
      </div>
    {!! Form::close() !!}
  @endif
@endcan