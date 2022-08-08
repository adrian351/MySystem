<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>{{ __('Archivos') }}</h5> 
  </div>
  <div class="card-body">
    @include('queja_y_sugerencia.archivo.arc_table')
    @include('global.paginador.paginador', ['paginar' => $archivos]) 
  </div>
</div>