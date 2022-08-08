<div class="row">
    <div class="form-group col-sm btn-sm">
        <label for="nombre">{{ __('Nombre') }}(s) *</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            {!! Form::text('nombre', null, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Nombre')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('nombre') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
        <label for="apellidos">{{ __('Apellidos') }} *</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            {!! Form::text('apellidos', null, ['class' => 'form-control' . ($errors->has('apellidos') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Apellidos')]) !!}
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
            {!! Form::text('correo_de_registro', null, ['class' => 'form-control' . ($errors->has('correo_de_registro') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo de registro')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('correo_de_registro') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
        <label for="correo_secundario">{{ __('Correo secundario') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            {!! Form::text('correo_secundario', null, ['class' => 'form-control' . ($errors->has('correo_secundario') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo secundario')]) !!}
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
            {!! Form::select('rol[]', $roles, null, ['class' => 'form-control select2' . ($errors->has('rol') ? ' is-invalid' : ''), 'multiple']) !!}
        </div>
        <span class="text-danger">{{ $errors->first('rol') }}</span>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm btn-sm">
        <label for="telefono_fijo">{{ __('Número de teléfono fijo a 10 dígitos') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-tty"></i></span>
            </div>
                <div>
                    {!! Form::number('lada_telefono_fijo', null, ['class' => 'form-control disabled' . ($errors->has('lada_telefono_fijo') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada'), 'readonly'=>'readonly']) !!}
                </div>
            {!! Form::text('telefono_fijo', null, ['class' => 'form-control' . ($errors->has('telefono_fijo') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono fijo')]) !!}
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
            {!! Form::text('extension', null, ['class' => 'form-control' . ($errors->has('extension') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Extensión')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('extension') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
        <label for="telefono_movil">{{ __('Número de teléfono móvil a 10 dígitos') }} *</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
            </div>
                <div>
                    {!! Form::number('lada_telefono_movil', null, ['class' => 'form-control disabled' . ($errors->has('lada_telefono_movil') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada'), 'readonly'=>'readonly']) !!}
                </div>
            {!! Form::text('telefono_movil', null, ['class' => 'form-control' . ($errors->has('telefono_movil') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono móvil')]) !!}
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
            {!! Form::text('empresa', null, ['class' => 'form-control' . ($errors->has('empresa') ? ' is-invalid' : ''), 'maxlength' => 200, 'placeholder' => __('Empresa')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('empresa') }}</span>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm btn-sm">
        <label for="password">{{ __('Contraseña') }} *</label>
        <a href="#" class="" data-toggle="modal" data-target="#generar-password" data-backdrop="static" data-keyboard="false">{{ __('Generar Contraseña') }}</a>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            {!! Form::password('password', ['id' => 'password', 'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Contraseña'), 'autocomplete' => 'new-password']) !!}
            <span class="input-group-append">
                <button id="show_password1" class="btn btn-info btn-flat btn-sm" type="button" onclick="mostrarPassword('password', 'show_password1', 'icon1')"><span class="fa fa-eye-slash icon1"></span></button>
            </span>
        </div>
        <span class="text-danger">{{ $errors->first('password') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
        <label for="password_confirmation">{{ __('Confirmación de contraseña') }} *</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Confirmación de contraseña')]) !!}
            <span class="input-group-append">
                <button id="show_password2" class="btn btn-info btn-flat btn-sm" type="button" onclick="mostrarPassword('password_confirmation', 'show_password2', 'icon2')"><span class="fa fa-eye-slash icon2"></span></button>
            </span>
        </div>
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
        <label for="plantilla">{{ __('Plantilla') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-brush"></i></span>
            </div>
            {!! Form::select('plantilla', $plantillas, $plantilla_default, ['class' => 'form-control select2' . ($errors->has('plantilla') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('plantilla') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
        <label for="checkbox_correo"></label>
        <div class="input-group p-2">
            <div class="custom-control custom-switch">
                {!! Form::checkbox('checkbox_correo', 'on', true, ['id' => 'checkbox_correo', 'class' => 'custom-control-input' . ($errors->has('checkbox_correo') ? ' is-invalid' : '')]) !!}
                <label class="custom-control-label" for="checkbox_correo">{{ __('Enviar correo de bienvenida') }}</label>
            </div>
        </div>
        <span class="text-danger">{{ $errors->first('checkbox_correo') }}</span>
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
    <div class="form-group col-sm btn-sm">
        <a href="{{ route('usuario.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
    </div>
    <div class="form-group col-sm btn-sm">
        <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
    </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')