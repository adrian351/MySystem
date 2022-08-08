<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>
      <strong>{{ __('Información de entrega') }} </strong>
    </h5>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => ['produccion.pedidoActivo.armado.show',Crypt::encrypt($armado->id)],'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('produccion.pedidoActivo.armado.show',Crypt::encrypt($armado->id)), 'opciones_buscador' => config('opcionesSelect.select_logistica_direcciones_index')])
    {!! Form::close() !!}
      @include('produccion.pedido.pedido_activo.armado_activo.direccion_armado.dirArm_table')
    @include('global.paginador.paginador', ['paginar' => $direcciones])
  </div>
</div>