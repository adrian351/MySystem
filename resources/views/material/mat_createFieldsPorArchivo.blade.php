<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="archivo">{{ __('Archivo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('archivo', ['class' => 'custom-file-input', 'lang' => 'es', 'multiple']) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('archivo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmitimport" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Subir archivo') }}</button>
  </div>
</div>