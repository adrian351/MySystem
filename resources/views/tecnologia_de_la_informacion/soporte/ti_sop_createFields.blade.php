<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_solicitante">{{ __('Nombre del solicitante') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
      </div>
      {!! Form::text('nombre_del_solicitante', null, ['class' => 'form-control' . ($errors->has('nombre_del_solicitante') ? ' is-invalid' : ''), 'maxlength' => 70, 'placeholder' => __('Nombre del solicitante')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_del_solicitante') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="empresa">{{ __('Empresa') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="far fa-building"></i></span>
      </div>
      {!! Form::text('empresa', null, ['class' => 'form-control' . ($errors->has('empresa') ? ' is-invalid' : ''), 'maxlength' => 70, 'placeholder' => __('Empresa')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('empresa') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="area_departamento">{{ __('Area o departamento') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-building"></i></span>
      </div>
      {!! Form::text('area_departamento', null, ['class' => 'form-control' . ($errors->has('area_departamento') ? ' is-invalid' : ''), 'maxlength' => 70, 'placeholder' => __('Area o departamento')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('area_departamento') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="archivo">{{ __('Archivos') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('archivos[]', ['class' => 'custom-file-input', 'lang' => 'es', 'multiple']) !!}
        <label class="custom-file-label" for="archivos">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('archivos.*') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="telefono_fijo">{{ __('Teléfono fijo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tty"></i></span>
      </div>
      {!! Form::text('telefono_fijo', null, ['class' => 'form-control' . ($errors->has('telefono_fijo') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono fijo')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('telefono_fijo') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="extension">{{ __('Extensión') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
      </div>
      {!! Form::text('extension', null, ['class' => 'form-control' . ($errors->has('extension') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Extensión')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('extension') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripcion_de_la_falla">{{ __('Descripción de la falla') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripcion_de_la_falla', null, ['class' => 'form-control' . ($errors->has('descripcion_de_la_falla') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Descripción de la falla'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('descripcion_de_la_falla') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('soporte.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Solicitar') }}</button>
  </div>
</div>