<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_plantilla">{{ __('Nombre de la plantilla') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-brush"></i></span>
      </div>
       {!! Form::text('nombre_de_la_plantilla', null, ['class' => 'form-control' . ($errors->has('nombre_de_la_plantilla') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Nombre de la plantilla')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_de_la_plantilla') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="modulo">{{ __('Módulo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('modulo', config('opcionesSelect.select_modulo'), null, ['class' => 'form-control select2' . ($errors->has('modulo') ? ' is-invalid' : '')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('modulo') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="asunto">{{ __('Asunto') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('asunto', null, ['class' => 'form-control' . ($errors->has('asunto') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Asunto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('asunto') }}</span>
  </div>
</div>
<hr>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('sistema.plantilla.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Crear') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')