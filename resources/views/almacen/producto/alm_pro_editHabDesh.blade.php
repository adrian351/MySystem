<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="habilitar_o_deshabilitar">{{ __('Habilitar o deshabilitar') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-question"></i></span>
      </div>
      {!! Form::select('habilitar_o_deshabilitar', config('opcionesSelect.select_habilitado_deshabilitado'), $producto->hab_desh, ['class' => 'form-control select2' . ($errors->has('habilitar_o_deshabilitar') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      <button type="submit" id="btnsubmit10" class="btn btn-info rounded ml-2" title="{{ __('Registrar') }}" onclick="return check('btnsubmit10', 'almacenProductoUpdateHabilitado', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-check-circle text-dark"></i></button>
    </div>
    <span class="text-danger">{{ $errors->first('habilitar_o_deshabilitar') }}</span>
  </div>
</div>