<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="input">{{ __('Input') }} ({{__('Selecciona la opción donde se desea guardar en valor')}}) *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('input', config('opcionesSelect.select_input'), $catalogo->input, ['class' => 'form-control select2' . ($errors->has('input') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('input') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="value">{{ __('Value') }} ({{__('Valor que se le va asignar')}}) *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('value', $catalogo->value, ['class' => 'form-control' . ($errors->has('value') ? ' is-invalid' : ''), 'maxlength' => 150, 'placeholder' => __('Value')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('value') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('sistema.catalogo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'sistemaCatalogoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')