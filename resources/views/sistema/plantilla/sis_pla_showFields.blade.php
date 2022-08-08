<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="created_at">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('created_at', $plantilla->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="created_at_us">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('created_at_us', $plantilla->created_at_plan, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="updated_at">{{ __('Fecha última modificación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('updated_at', $plantilla->updated_plan, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="updated_at_us">{{ __('Última modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('updated_at_us', $plantilla->updated_at_plan, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_plantilla">{{ __('Nombre de la plantilla') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-brush"></i></span>
      </div>
      {!! Form::text('nombre_de_la_plantilla', $plantilla->nom, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre de la plantilla'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_plantilla">{{ __('Módulo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::text('nombre_de_la_plantilla', $plantilla->mod, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Módulo'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="asunto">{{ __('Asunto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('asunto', $plantilla->asunt, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Asunto'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="diseño_de_la_plantilla">{{ __('Diseño de la plantilla') }}</label>
    <div class="input-group">
       {!! Form::textarea('diseño_de_la_plantilla', $plantilla->dis_de_la_plant, ['class' => 'form-control textarea disabled', 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('sistema.plantilla.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_summernote')
@section('js1')
<script>
  $('.textarea').summernote({
  disableDragAndDrop: false
});
</script>
@endsection