<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <div class="float-right">
      <h5>{{ __('Armados registrados') }}: @include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados')</h5> 
    </div>
  </div>
  <div class="card-body">
    @include('rastrea.pedido.armado.arm_table')
    @include('global.paginador.paginador', ['paginar' => $armados]) 
  </div>
</div>