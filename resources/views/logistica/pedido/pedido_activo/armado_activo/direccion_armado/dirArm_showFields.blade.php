@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.created')
<div class="row">
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.cantidad')
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.estatus', ['armado' => $direccion])
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.conOSinCaja')
</div>
@if($direccion->coment_estatus != null)
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="cantidad">{{ __('Comentario estatus') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::textarea('coment_estatus', $direccion->coment_estatus, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Especificaciones del estatus'),'rows' => 3, 'cols' => 3, 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
@endif

@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.infoExtra')
@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.envioAlQueSeCotizo')
@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.metodoDeEntregaLogistica')
@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.comprobantes')
@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_showFields.infoDeEntrega')