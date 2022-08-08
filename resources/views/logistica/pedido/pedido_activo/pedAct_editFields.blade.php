<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="bodega_donde_se_armara">{{ __('Bodega donde se armara') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('bodega_donde_se_armara', config('opcionesSelect.select_bodega_donde_se_armara'), $pedido->bod, ['class' => 'form-control select2' . ($errors->has('bodega_donde_se_armara') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('bodega_donde_se_armara') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentario_logistica">{{ __('Comentario logística') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentario_logistica', $pedido->coment_log, ['class' => 'form-control' . ($errors->has('comentario_logistica') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentario logística'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentario_logistica') }}</span>
  </div>
</div>