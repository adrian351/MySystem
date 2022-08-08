<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    @if(Request::route()->getName() == 'cotizacion.armado.edit')
      @include('cotizacion.armado_cotizacion.producto_armado.cot_arm_pro_create')
    @endif
    {{-- <h5>{{ __('Productos') }}</h5>  --}}
  </div>
  <div class="card-body">
    @include('cotizacion.armado_cotizacion.producto_armado.cot_arm_pro_table')
    @include('global.paginador.paginador', ['paginar' => $productos])
  </div>
</div>