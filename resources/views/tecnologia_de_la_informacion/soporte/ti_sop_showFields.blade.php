<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="creacion_de_registro">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
        {!! Form::text("creacion_de_registro", $soporte->created_at, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
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
        {!! Form::text("actualizacion_del_registro", $soporte->updated_at, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="modificado_por">{{ __('Última modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
        {!! Form::text("modificado_por", $soporte->update_at_sop, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
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
    <label for="empresa">{{ __('Empresa') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="far fa-building"></i></span>
      </div>
        {!! Form::text("empresa", $soporte->emp, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Empresa'), 'readonly' => 'readonly']) !!}
    </div>
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
    <label for="area_departamento">{{ __('Area o Departamento') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-building"></i></span>
      </div>
        {!! Form::text("area_departamento", $soporte->area_dep, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Area o Departamento'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="estatus_del_soporte">{{ __('Estatus del soporte') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text("estatus_del_soporte", $soporte->est, ['class' => 'form-control disabled', 'maxlength' => 40, 'placeholder' => __('Estatus del soporte'), 'readonly' => 'readonly']) !!}
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
      {!! Form::textarea('des_de_la_falla', $soporte->des_de_la_falla, ['class' => 'form-control disable', 'maxlength' => 00, 'placeholder' => __('Descripción de la falla'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
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
      {!! Form::textarea('solu', $soporte->solu, ['class' => 'form-control disable', 'maxlength' => 00, 'placeholder' => __('Solución'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
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
      {!! Form::textarea('obs_del_equipo', $soporte->obs_del_equipo, ['class' => 'form-control disable', 'maxlength' => 00, 'placeholder' => __('Observaciones del equipo'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('soporte.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection