<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_solicitante">{{ __('Nombre del Solicitante') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
      </div>
        {!! Form::text("nombre_del_solicitante", $soporte->sol, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Nombre del Solicitante'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="empresa">{{ __('Empresa') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="far fa-building"></i></span>
      </div>
      {!! Form::text('empresa', $soporte->emp, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Empresa'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="area_departamento">{{ __('Area o Departamento') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-building"></i></span>
      </div>
      {!! Form::text('area_departamento', $soporte->area_dep, ['class' => 'form-control disabled', 'maxlength' => 30, 'placeholder' => __('Area o Departamento'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="estatus_del_soporte">{{ __('Estatus del soporte') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('estatus_del_soporte', config('opcionesSelect.select_estatus_soporte'), $soporte->est, ['class' => 'form-control select2' . ($errors->has('estatus_del_soporte') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('estatus_del_soporte') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_tecnico">{{ __('Nombre del técnico') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
      </div>
      {!! Form::text('nombre_del_tecnico', $soporte->tec, ['class' => 'form-control' . ($errors->has('nombre_del_tecnico') ? ' is-invalid' : ''), 'maxlength' => 70, 'placeholder' => __('Nombre del técnico')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_del_tecnico') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="id_inventario">{{ __('ID inventario') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('id_inventario', $inventario_equipo_list, $soporte->id_equipo, ['class' => 'form-control select2' . ($errors->has('id_inventario') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('id_inventario') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="telefono_fijo">{{ __('Teléfono fijo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tty"></i></span>
      </div>
        {!! Form::text("telefono_fijo", $soporte->tel_fij, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Teléfono fijo'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="extension">{{ __('Extensión') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
      </div>
      {!! Form::text('extension', $soporte->ext, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Extensión'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="agrupacion_de_fallas">{{ __('Agrupación de fallas') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar Agrupación') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('agrupacion_de_fallas', $agrupacion_de_fallas_list, $soporte->grup_de_falla, ['class' => 'form-control select2' . ($errors->has('agrupacion_de_fallas') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('agrupacion_de_fallas') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripcion_de_la_falla">{{ __('Descripción de la falla') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripcion_de_la_falla', $soporte->des_de_la_falla, ['class' => 'form-control disabled', 'maxlength' => 30000, 'placeholder' => __('Descripción de la falla'),  'readonly' => 'readonly', 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('descripcion_de_la_falla') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="solucion">{{ __('Solución') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('solucion', $soporte->solu, ['class' => 'form-control' . ($errors->has('solucion') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Solución'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('solucion') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="observaciones_del_equipo">{{ __('Observaciones del equipo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('observaciones_del_equipo', $soporte->obs_del_equipo, ['class' => 'form-control' . ($errors->has('observaciones_del_equipo') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Observaciones del equipo'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('observaciones_del_equipo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('soporte.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'soporteUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')