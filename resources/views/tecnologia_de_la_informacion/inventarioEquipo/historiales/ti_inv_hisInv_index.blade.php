<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>{{ __('Historial') }}</h5> 
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => [Request::is('ti/inventario/editar/*') ? 'inventario.edit' : 'inventario.show', Crypt::encrypt($inventario->id)], 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route(Request::is('ti/inventario/editar/*') ? 'inventario.edit' : 'inventario.show', Crypt::encrypt($inventario->id)), 'opciones_buscador' => config('opcionesSelect.select_inventario_historial')])
    {!! Form::close() !!}
    @include('tecnologia_de_la_informacion.inventarioEquipo.historiales.ti_inv_hisInv_table')
    @include('global.paginador.paginador', ['paginar' => $historiales])  
  </div>
</div>