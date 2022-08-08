<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>
      <strong>{{ __('Armados registrados') }}: </strong>@include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados'),
      <strong>{{ __('Entregados') }}: </strong> {{ Sistema::dosDecimales($armados_entregados_logistica) }}
    </h5>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => ['logistica.pedidoEntregado.show', Crypt::encrypt($pedido->id)], 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('logistica.pedidoEntregado.show', Crypt::encrypt($pedido->id)), 'opciones_buscador' => config('opcionesSelect.select_produccion_pedido_armados_index')])
    {!! Form::close() !!}
    @include('logistica.pedido.pedido_entregado.armado_entregado.armEnt_table')
    @include('global.paginador.paginador', ['paginar' => $armados])
  </div>
</div>