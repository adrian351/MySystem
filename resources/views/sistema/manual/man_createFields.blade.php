<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="usuario_que_puede_visualizarlo">{{ __('Usuario que puede visualizarlo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('usuario_que_puede_visualizarlo', config('opcionesSelect.select_usu_cli_ambos'), null, ['class' => 'form-control select2' . ($errors->has('usuario_que_puede_visualizarlo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('usuario_que_puede_visualizarlo') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="valor">{{ __('Valor') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('valor', null, ['class' => 'form-control' . ($errors->has('valor') ? ' is-invalid' : ''), 'maxlength' => 42, 'placeholder' => __('Valor')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('valor') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="archivo_editable">{{ __('Archivo editable') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('archivo_editable', ['id' => 'archivo_editable', 'class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo_editable">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('archivo_editable') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="archivo">{{ __('Archivo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('archivo', ['id' => 'archivo', 'class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('archivo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('manual.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Subir') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')