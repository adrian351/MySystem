<div class="row">
  <div class='form-group col-sm btn-sm'>
    <label for="responsable">{{ __('Responsable')}} *</label>
    <div class="input-group">
       <div class="input-group-prepend">
         <span class="input-group-text"><i class="fas fa-user"></i></span>
       </div>
       {!! Form::text('responsable', $inventario->resp, ['class' => 'form-control' .($errors->has('responsable') ? ' is-invalid' : ''), 'maxlength' => 80, 'placeholder' => __('Responsable')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('responsable')}}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="empresa">{{ __('Empresa') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="far fa-building"></i></span>
      </div>
      {!! Form::text('empresa', $inventario->emp, ['class' => 'form-control' .($errors->has('empresa') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Empresa')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('empresa')}}</span>
  </div>
</div>
<div class="row">
  <div class='form-group col-sm btn-sm'>
    <label for="marca">{{ __('Marca')}} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('marca', $inventario->mar, ['class' => 'form-control' .($errors->has('marca') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Marca')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('marca')}}</span>
  </div>
  <div class='form-group col-sm btn-sm'>
    <label for="modelo">{{ __('Modelo')}} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('modelo', $inventario->mod, ['class' => 'form-control' .($errors->has('modelo') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Modelo')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('modelo')}}</span>
  </div>
</div>
<div class="row">
  <div class='form-group col-sm btn-sm'>
    <label for="numero_serie">{{ __('Número de serie')}} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
      </div>
      {!! Form::text('numero_serie', $inventario->num_ser, ['class' => 'form-control' .($errors->has('numero_serie') ? ' is-invalid' : ''), 'maxlength' => 40, 'placeholder' => __('Número de serie')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('numero_serie')}}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="ultimo_mantenimiento">{{ __('Último mantenimiento')}}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
      {!! Form::date('ultimo_mantenimiento', $inventario->ult_fec_de_man, ['class' => 'form-control']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('ultimo_mantenimiento') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripciom_equipo">{{ __('Descripción del equipo') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripciom_equipo', $inventario->des_del_equ, ['class' => 'form-control' . ($errors->has('descripciom_equipo') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Descripción del equipo'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('descripciom_equipo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="observaciones">{{ __('Observaciones') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('observaciones', $inventario->obs, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Observaciones'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('observaciones') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('inventario.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'inventarioUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>