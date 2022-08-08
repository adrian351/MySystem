<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad">{{ __('Cantidad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('cantidad', null, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Cantidad')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('cantidad') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="sustituto">{{ __('Sustituto') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('sustituto', $sustitutos_list, [], ['class' => 'form-control select2' . ($errors->has('sustituto') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('sustituto') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('almacen.pedidoActivo.armado.edit', Crypt::encrypt($producto->pedido_armado_id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Continuar con el armado') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'almacenPedidoActivoArmadoSistitutoStore', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-check-circle text-dark"></i> {{ __('Agregar sustituto') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')