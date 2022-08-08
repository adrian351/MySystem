<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="tipo">{{ __('Tipo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo', config('opcionesSelect.select_queja_o_sugerencia'), null, ['class' => 'form-control select2' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="departamento">{{ __('Departamento') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('departamento', config('opcionesSelect.select_departamento'), null, ['class' => 'form-control select2' . ($errors->has('departamento') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('departamento') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="archivos">{{ __('Archivos') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('archivos[]', ['class' => 'custom-file-input' . ($errors->has('archivos.*') ? ' is-invalid' : ''), 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang, 'multiple']) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('archivos.*') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="observaciones">{{ __('Observaciones') }} *</label>
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
    <center><button type="submit" id="btnsubmit" class="btn btn-info w-50 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')