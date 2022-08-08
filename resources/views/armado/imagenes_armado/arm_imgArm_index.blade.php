<div class="card {{ config('app.color_card_terciario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_terciario') }}">
    @include('armado.imagenes_armado.arm_imgArm_create')
    <h5>
      <strong>{{ __('Galería de imágenes') }}</strong>
    </h5>
  </div>
  <div class="card-body">
    @include('armado.imagenes_armado.arm_imgArm_table')
    @include('global.paginador.paginador', ['paginar' => $imagenes])
  </div>
</div>