<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    @include('armado.producto_armado.arm_proArm_create')
    {{-- <h5>{{ __('Productos') }}</h5>  --}}
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => [Request::is('armado/editar/*') ? 'armado.edit' : 'armado.show', Crypt::encrypt($armado->id)], 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route(Request::is('armado/editar/*') ? 'armado.edit' : 'armado.show', Crypt::encrypt($armado->id)), 'opciones_buscador' => config('opcionesSelect.select_producto_armado_index')])
    {!! Form::close() !!}
    @include('armado.producto_armado.arm_proArm_table')
    @include('global.paginador.paginador', ['paginar' => $productos])
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')