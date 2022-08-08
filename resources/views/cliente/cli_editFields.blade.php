<div class="row">
  <div class="form-group col-sm btn-sm">
    <div class="input-group justify-content-center">
      @if($cliente->img_us != null)
        <img src="{{ $cliente->img_us_rut.$cliente->img_us }}" class="profile-user-img img-fluid img-circle" alt="{{ $cliente->img_us }}">
      @else
        <img src="{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf_rut . Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}" class="profile-user-img img-fluid img-circle" alt="{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}">
      @endif
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre">{{ __('Nombre') }}(s) *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
      </div>
        {!! Form::text('nombre', $cliente->nom, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Nombre')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="apellidos">{{ __('Apellidos') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
      </div>
      {!! Form::text('apellidos', $cliente->apell, ['class' => 'form-control' . ($errors->has('apellidos') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Apellidos')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('apellidos') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="correo_de_registro">{{ __('Correo de registro') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
        {!! Form::text('correo_de_registro', $cliente->email_registro, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Correo de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="correo_de_acceso">{{ __('Correo de acceso') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
        {!! Form::text('correo_de_acceso', $cliente->email, ['class' => 'form-control' . ($errors->has('correo_de_acceso') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo de acceso')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('correo_de_acceso') }}</span>
  </div>
  </div>
  <div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="correo_secundario">{{ __('Correo secundario') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('correo_secundario', $cliente->email_secund, ['class' => 'form-control' . ($errors->has('correo_secundario') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo secundario')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('correo_secundario') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="rol">{{ __('Rol') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dice-six"></i></span>
      </div>
      {!! Form::select('rol[]', $roles, $cliente->roles, ['class' => 'form-control select2' . ($errors->has('rol') ? ' is-invalid' : ''), 'multiple']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('rol') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="telefono_fijo">{{ __('Teléfono fijo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tty"></i></span>
      </div>
      {!! Form::number('lada_telefono_fijo', $cliente->lad_fij, ['class' => 'form-control' . ($errors->has('lada_telefono_fijo') ? ' is-invalid' : ''), 'maxlength' => 4, 'placeholder' => __('Lada teléfono fijo')]) !!}
      {!! Form::text('telefono_fijo', $cliente->tel_fij, ['class' => 'form-control' . ($errors->has('telefono_fijo') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono fijo')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('lada_telefono_fijo') }}</span>
    <span class="text-danger">{{ $errors->first('telefono_fijo') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="extension">{{ __('Extensión') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
      </div>
        {!! Form::text('extension', $cliente->ext, ['class' => 'form-control' . ($errors->has('extension') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Extensión')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('extension') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="telefono_movil">{{ __('Teléfono móvil') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
      </div>
        {!! Form::number('lada_telefono_movil', $cliente->lad_mov, ['class' => 'form-control' . ($errors->has('lada_telefono_movil') ? ' is-invalid' : ''), 'maxlength' => 4, 'placeholder' => __('Lada teléfono móvil')]) !!}
        {!! Form::text('telefono_movil', $cliente->tel_mov, ['class' => 'form-control' . ($errors->has('telefono_movil') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono móvil')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('lada_telefono_movil') }}</span>
    <span class="text-danger">{{ $errors->first('telefono_movil') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="empresa">{{ __('Empresa') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="far fa-building"></i></span>
      </div>
      {!! Form::text('empresa', $cliente->emp, ['class' => 'form-control' . ($errors->has('empresa') ? ' is-invalid' : ''), 'maxlength' => 200, 'placeholder' => __('Empresa')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('empresa') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="observaciones">{{ __('Observaciones') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width "></i></span>
      </div>
      {!! Form::textarea('observaciones', $cliente->obs, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Observaciones'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('observaciones') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="notificaciones"></label>
    <div class="input-group p-2">
      <div class="custom-control custom-switch">
        {!! Form::checkbox('notificaciones', 'on', $cliente->notif, ['id' => 'notificaciones', 'class' => 'custom-control-input' . ($errors->has('notificaciones') ? ' is-invalid' : '')]) !!}
        <label class="custom-control-label" for="notificaciones">{{ __('Recibir notificaciones') }}</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('notificaciones') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="imagen">{{ __('Imagen') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('imagen', ['id' => 'imagen', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen", "visualizar-imagen")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
      <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
    </div>
    <span class="text-danger">{{ $errors->first('imagen') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <center>
      <figure>
        <div id="visualizar-imagen"></div>
      </figure>
    </center>
  </div>
</div>
<hr>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('cliente.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'clienteUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')