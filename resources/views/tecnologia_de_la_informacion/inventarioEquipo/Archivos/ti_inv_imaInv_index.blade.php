<div class="card {{ config('app.color_card_terciario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_terciario') }}">
    @include('tecnologia_de_la_informacion.inventarioEquipo.Archivos.ti_inv_imaInv_create')
    <h5>
      <strong>{{ __('Galería de imágenes') }}</strong>
    </h5>
  </div>
  <div class="card-body">
    @include('tecnologia_de_la_informacion.inventarioEquipo.Archivos.ti_inv_imaInv_table')
    @include('global.paginador.paginador',['paginar' => $archivos])
  </div>
</div>