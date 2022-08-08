<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <div class="float-right">
      <h5>
        {{ __('Estatus pago') }}: @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago') | 
        {{ __('Monto total del pedido') }}: @include('venta.pedido.pedido_activo.ven_pedAct_showFields.montoTotalDelPedido')
      </h5> 
    </div>
  </div>
  <div class="card-body">
    @include('rolCliente.pedido.pago.pag_table')
    @include('global.paginador.paginador', ['paginar' => $pagos]) 
  </div>
</div>