<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="created_at">{{ __('Fecha de registro') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
      {!! Form::text('created_at', $historial->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly'])!!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="created_at_historial">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('created_at_historial', $historial->created_at_his, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly'])!!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
      <label for="actualizado">{{ __('Fecha última modificación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
      {!! Form::text('actualizado', $historial->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly'])!!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="fecha_entrega">{{ __('Fecha de entrega') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('fecha_entrega', $historial->fec_ent, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de entrega'), 'readonly' => 'readonly'])!!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
      <label for="solicitante">{{ __('Solicitante') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
      </div>
      {!! Form::text('solicitante', $historial->sol, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Solicitante'), 'readonly' => 'readonly'])!!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="area_departamento">{{ __('Area o Departamento') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-building"></i></span>
      </div>
      {!! Form::text('area_departamento', $historial->area_dep, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Area o Departamento'), 'readonly' => 'readonly'])!!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
      <label for="nombre_del_tecnico">{{ __('Nombre del técnico') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-user"></i></span>
        </div>
        {!! Form::text('nombre_del_tecnico', $historial->area_dep, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre del técnico'), 'readonly' => 'readonly'])!!}
      </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="agrupacion_de_fallas">{{ __('Agrupación de fallas') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('agrupacion_de_fallas', $historial->grup_de_falla, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Agrupación de fallas'), 'readonly' => 'readonly'])!!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="des_de_la_falla">{{ __('Descripción de la falla') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('des_de_la_falla', $historial->des_de_la_falla, ['class' => 'form-control disable', 'maxlength' => 00, 'placeholder' => __('Descripción de la falla'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
  <label for="solu">{{ __('Solución') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('solu', $historial->solu, ['class' => 'form-control disable', 'maxlength' => 00, 'placeholder' => __('Soluciion'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="obs_del_equipo">{{ __('Observaciones del equipo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('obs_del_equipo', $historial->obs_del_equipo, ['class' => 'form-control disable', 'maxlength' => 00, 'placeholder' => __('Observaciones del equipo'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('inventario.show', Crypt::encrypt($historial->equipo->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Continuar con el inventario') }}</a></center>
  </div>
</div>