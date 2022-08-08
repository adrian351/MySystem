<div class="card {{ config('app.color_card_secundario') }}">
  <div class="card-header p-1 {{ config('app.color_bg_secundario') }}">
    <h5>{{ __('Direcciones') }}</h5> 
  </div>
  <div class="card-body">
      @include('rastrea.pedido.armado.direccion.dir_table')
    @include('global.paginador.paginador', ['paginar' => $direcciones]) 
  </div>
</div>