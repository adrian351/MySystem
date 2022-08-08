<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    @include('almacen.producto.sustitutos_producto.alm_pro_susPro_create')
    <h5>{{ __('Sustitutos') }}</h5> 
  </div>
  <div class="card-body">
    @include('almacen.producto.sustitutos_producto.alm_pro_susPro_table', [$productos = $sustitutos])
    @include('global.paginador.paginador', ['paginar' => $sustitutos])
  </div>
</div>