<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_rol">{{ __('Nombre del rol') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dice-six"></i></span>
      </div>
       {!! Form::text('nombre_del_rol', $rol->nom, ['class' => 'form-control' . ($errors->has('nombre_del_rol') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Nombre del rol')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_del_rol') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="slug">{{ __('Slug') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('slug', $rol->name, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Slug'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="permisos">{{ __('Permisos') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('permisos[]', $permisos, $rol->permissions, ['class' => 'form-control select2' . ($errors->has('permisos') ? ' is-invalid' : ''), 'multiple']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('permisos') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripcion">{{ __('Descripción') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripcion', $rol->desc, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Descripción'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('descripcion') }}</span>
  </div>
</div>
<hr>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('rol.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'rolUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')