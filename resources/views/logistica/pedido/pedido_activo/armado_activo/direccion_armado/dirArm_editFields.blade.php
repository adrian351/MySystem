<div class="row">
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.cantidad')
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.nombreDeArmado')
</div>
@include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.productosArmado')

<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="estatus">{{ __('Estatus') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('estatus', config('opcionesSelect.select_estatus_logistica_direcciones'), $armado->estat, ['class' => 'form-control select2' . ($errors->has('estatus') ? ' is-invalid' : ''), 'id' => 'estatDireccion', 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first(' ') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentario_estatus">{{ __('Comentario estatus') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentario_estatus', $armado->coment_estatus, ['class' => 'form-control' . ($errors->has('comentario_estatus') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentario estatus'), 'id' => 'campo', 'rows' => 3, 'cols' => 3]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentario_estatus') }}</span>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')