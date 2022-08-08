<div class="card {{ config('app.color_card_terciario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_terciario') }}">
    @include('almacen.producto.imagenes.img_create')
    <h5><strong>{{ __('Galería de imágenes') }}</strong></h5>
  </div>
  <div class="card-body">
    @include('almacen.producto.imagenes.img_table')
    @include('global.paginador.paginador', ['paginar' => $imagenes])
  </div>
</div>