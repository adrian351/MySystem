<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>{{ __('Archivos guardados') }}</h5>
    @include('venta.pedido.pedido_activo.archivo.arc_create')
  </div>
  <div class="card-body">
    @include('venta.pedido.pedido_activo.archivo.arc_table')
    @include('global.paginador.paginador', ['paginar' => $archivos]) 
  </div>
</div>