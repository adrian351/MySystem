<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>
      <strong>{{ __('Armados registrados') }}: </strong>@include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados'),
      <strong>{{ __('Terminados') }}: </strong> {{ Sistema::dosDecimales($armados_terminados_almacen) }}
    </h5>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => ['almacen.pedidoTerminado.show',Crypt::encrypt($pedido->id)],'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('almacen.pedidoTerminado.show',Crypt::encrypt($pedido->id)), 'opciones_buscador' => config('opcionesSelect.select_pedido_armados_index')])
    {!! Form::close() !!}
    @include('almacen.pedido.pedido_terminado.armado_terminado.armTer_table')
    @include('global.paginador.paginador', ['paginar' => $armados])
  </div>
</div>