<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_ruta">{{ __('Nombre de la ruta') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('nombre_de_la_ruta', $ruta->nom, ['class' => 'form-control' . ($errors->has('nombre_de_la_ruta') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Nombre de la ruta')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_de_la_ruta') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('rolFerro.ruta.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'rolFerroRutaUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>