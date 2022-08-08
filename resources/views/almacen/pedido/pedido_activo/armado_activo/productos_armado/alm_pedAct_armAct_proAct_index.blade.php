<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>
      <strong>{{ __('Productos') }} </strong>
    </h5>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => ['almacen.pedidoActivo.armado.edit',Crypt::encrypt($armado->id)],'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('almacen.pedidoActivo.armado.edit',Crypt::encrypt($armado->id)), 'opciones_buscador' => config('opcionesSelect.select_productos_armado_index')])
    {!! Form::close() !!}
    @include('almacen.pedido.pedido_activo.armado_activo.productos_armado.alm_pedAct_armAct_proAct_table')
    @include('global.paginador.paginador', ['paginar' => $productos])
  </div>
</div>