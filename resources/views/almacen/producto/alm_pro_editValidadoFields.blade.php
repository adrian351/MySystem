<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="producto_validado">{{ __('¿Producto validado?') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-question"></i></span>
      </div>
      {!! Form::select('producto_validado', config('opcionesSelect.select_si_no'), $producto->prod_valid, ['class' => 'form-control select2' . ($errors->has('producto_validado') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      <button type="submit" id="btnsubmit" class="btn btn-info rounded ml-2" title="{{ __('Registrar') }}" onclick="return check('btnsubmit', 'almacenProductoUpdateValidado', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-check-circle text-dark"></i></button>
    </div>
    <span class="text-danger">{{ $errors->first('producto_validado') }}</span>
  </div>
</div>