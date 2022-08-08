<div class="form-group row">
  <label for="nombre" class="campo col-sm-2 col-form-label">{{ __('Nombre') }}(s) *</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::text('nombre', Auth::user()->nom, ['class' => 'input form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Nombre')]) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="fas fa-user"></i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('nombre') }}</span>
  </div>
</div>
<div class="form-group row">
  <label for="apellidos" class="campo col-sm-2 col-form-label">{{ __('Apellidos') }} *</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::text('apellidos', Auth::user()->apell, ['class' => 'input form-control' . ($errors->has('apellidos') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Apellidos')]) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="fas fa-user"></i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('apellidos') }}</span>
  </div>
</div>
<div class="form-group row">
  <label for="apellidos" class="campo col-sm-2 col-form-label">{{ __('Correo de registro') }} *</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::text('correo_de_registro', Auth::user()->email_registro, ['class' => 'input form-control disabled', 'maxlength' => 0, 'placeholder' => __('Correo de registro'), 'readonly' => 'readonly']) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="correo_de_acceso" class="campo col-sm-2 col-form-label">{{ __('Correo de acceso') }} *</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::text('correo_de_acceso', Auth::user()->email, ['class' => 'input form-control' . ($errors->has('correo_de_acceso') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo de acceso')]) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('correo_de_acceso') }}</span>
  </div>
</div>
<div class="form-group row">
  <label for="password" class="campo col-sm-2 col-form-label">{{ __('Contraseña') }}</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::password('password', ['id' => 'password', 'class' => 'input form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Contraseña'), 'autocomplete' => 'new-password']) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="fas fa-lock"></i></span>
      </div>
    </div>
    <span class="text-muted">{{ __('Si no quieres cambiar tu contraseña, déjala en blanco') }}.</span>
    <span class="text-danger">{{ $errors->first('password') }}</span>
  </div>
</div>
<div class="form-group row">
  <label for="password_confirmation" class="campo col-sm-2 col-form-label">{{ __('Confirmación de contraseña') }}</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'input form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Confirmación de contraseña')]) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="fas fa-lock"></i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
  </div>
</div>
<div class="form-group row">
  <label for="correo_secundario" class="campo col-sm-2 col-form-label">{{ __('Correo secundario') }}</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::text('correo_secundario', Auth::user()->email_secund, ['class' => 'input form-control' . ($errors->has('correo_secundario') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo secundario')]) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('correo_secundario') }}</span>
  </div>
</div>
<div class="form-group row">
  <label for="telefono_fijo" class="campo col-sm-2 col-form-label">{{ __('Teléfono fijo') }}</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::number('lada_telefono_fijo', Auth::user()->lad_fij, ['class' => 'input form-control' . ($errors->has('lada_telefono_fijo') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada teléfono fijo')]) !!}
      {!! Form::text('telefono_fijo', Auth::user()->tel_fij, ['class' => 'input form-control' . ($errors->has('telefono_fijo') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono fijo')]) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="fas fa-tty"></i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('lada_telefono_fijo') }}</span>
    <span class="text-danger">{{ $errors->first('telefono_fijo') }}</span>
  </div>
</div>
<div class="form-group row">
  <label for="extension" class="campo col-sm-2 col-form-label">{{ __('Extensión') }}</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::text('extension', Auth::user()->ext, ['class' => 'input form-control' . ($errors->has('extension') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Extensión')]) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="fas fa-phone"></i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('extension') }}</span>
  </div>
</div>
<div class="form-group row">
  <label for="telefono_movil" class="campo col-sm-2 col-form-label">{{ __('Teléfono móvil') }} *</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::number('lada_telefono_movil', Auth::user()->lad_mov, ['class' => 'input form-control' . ($errors->has('lada_telefono_movil') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada teléfono móvil')]) !!}
      {!! Form::text('telefono_movil', Auth::user()->tel_mov, ['class' => 'input form-control' . ($errors->has('telefono_movil') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono móvil')]) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="fas fa-mobile-alt"></i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('lada_telefono_movil') }}</span>
    <span class="text-danger">{{ $errors->first('telefono_movil') }}</span>
  </div>
</div>
<div class="form-group row">
  <label for="empresa" class="campo col-sm-2 col-form-label">{{ __('Empresa') }}</label>
  <div class="col-sm-8">
    <div class="input-group">
      {!! Form::text('empresa', Auth::user()->emp, ['class' => 'input form-control' . ($errors->has('empresa') ? ' is-invalid' : ''), 'maxlength' => 200, 'placeholder' => __('Empresa')]) !!}
      <div class="input-group-prepend">
        <span class="ci input-group-text"><i class="far fa-building"></i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('empresa') }}</span>
  </div>
</div>
<div class="form-group row">
  <label for="imagen" class="campo col-sm-2 col-form-label">{{ __('Imagen') }}</label>
  <div class="col-sm-8">
    <div class="input-group">
      <div class="custom-file"> 
        {!! Form::file('imagen', ['id' => 'imagen', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen", "visualizar-imagen")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
        <label class="input custom-file-label" for="archivo">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('imagen') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><figure>
      <div id="visualizar-imagen"></div>
    </figure></center>
  </div>
</div>
<div class="form-group row">
  <div class="offset-sm-4 col-sm-4">
    <center><button type="submit" id="btnsubmit" class="btn_perfil btn btn w-75 p-2" onclick="return check('btnsubmit', 'perfilUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar tu información?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button></center>
  </div>
</div>