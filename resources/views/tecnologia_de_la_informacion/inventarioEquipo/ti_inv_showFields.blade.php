<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="creacion_de_registro">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
      {!! Form::text("creacion_de_registro", $inventario->created_at, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="inventario_registrado">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('inventario_registrado', $inventario->created_at_inv_equ, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="actualizacion_del_registro">{{ __('Fecha última modificación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
      {!! Form::text("actualizacion_del_registro", $inventario->updated_at, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="modificado_por">{{ __('Última modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('modificado_por', $inventario->updated_at_inv_equ, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="id_del_equipo">{{ __('Id equipo')}}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
      </div>
      {!! Form::text('id_del_equipo', $inventario->id_equipo, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Id equipo'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="responsable">{{ __('Responsable')}}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
      </div>
      {!! Form::text('responsable', $inventario->resp, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Responsable'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="empresa">{{ __('Empresa')}}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="far fa-building"></i></span>
      </div>
      {!! Form::text('empresa', $inventario->emp, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Empresa'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="marca">{{ __('Marca')}}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('marca', $inventario->mar, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Marca'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="modelo">{{ __('Modelo')}}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('modelo', $inventario->mod, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Modelo'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="numero_serie">{{ __('Número de serie')}}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
      </div>
      {!! Form::text('numero_serie', $inventario->num_ser, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Número de serie'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="ultimo_mantenimiento">{{ __('Último mantenimiento')}}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
      {!! Form::text('ultimo_mantenimiento', $inventario->ult_fec_de_man, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Último mantenimiento'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
  <label for="proximo_mantenimiento">{{ __('Próximo mantenimiento')}}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
      {!! Form::text('proximo_mantenimiento', $inventario->prox_fec_de_man, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Próximo mantenimiento'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripciom_equipo">{{ __('Descripción del equipo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripciom_equipo', $inventario->des_del_equ, ['class' => 'form-control disable', 'maxlength' => 00, 'placeholder' => __('Descripción del equipo'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
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
      {!! Form::textarea('observaciones', $inventario->obs, ['class' => 'form-control disable', 'maxlength' => 00, 'placeholder' => __('Observaciones'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('inventario.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>