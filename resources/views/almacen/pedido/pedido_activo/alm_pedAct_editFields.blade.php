<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="persona_que_recibe">{{ __('Persona que recibe') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('persona_que_recibe', $pedido->per_reci_alm, ['class' => 'form-control' . ($errors->has('persona_que_recibe') ? ' is-invalid' : ''), 'maxlength' => 80, 'placeholder' => __('Persona que recibe')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('persona_que_recibe') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentario_almacen">{{ __('Comentario almacén') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentario_almacen', $pedido->coment_alm, ['class' => 'form-control' . ($errors->has('comentario_almacen') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentario almacén'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentario_almacen') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('almacen.pedidoActivo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'almacenPedidoActivoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar pedido') }}</button>
  </div>
</div>