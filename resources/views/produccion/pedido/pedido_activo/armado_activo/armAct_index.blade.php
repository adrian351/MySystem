<div class="card {{ config('app.color_card_dark') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_dark') }}">
    <div class="row">
      <div class="col-sm-7 btn-sm">
        <div class="input-group-append">
          <h5>
            <strong class=" col-sm col-form-label">{{ __('Armados registrados') }}: </strong>@include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados'),
            <strong class="col-form-label">{{ __('Terminados') }}: </strong> {{ Sistema::dosDecimales($armados_terminados_produccion) }}
          </h5>
        </div>
      </div>
      @if(Request::route()->getName() == 'produccion.pedidoActivo.edit')
        @if($cant_armados_estatus_produccion != 0)
          @can('produccion.pedidoActivo.armado.edit')
          <div class="col-sm-5">
            {!! Form::open(['route' => ['produccion.pedidoActivo.asignarRackArmados', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'produccionPedidoActivoArmadoTerminarArmados']) !!}
            <div class="form-group row justify-content-end m-0">
              <div class="col-sm-8 btn-sm">
                <div class="input-group-append">
                  <input class="form-control" type="text" placeholder="{{ __('Agregar rack a todos los armados') }}" name="ubicacion_rack"/>
                </div>
                <span class="text-danger">{{ $errors->first('ubicacion_rack') }}</span>
              </div>  
              <div class="col-sm-4 btn-sm">
                <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'produccionPedidoActivoArmadoTerminarArmados', '¡Alerta!', 'Se le asignará el mismo rack a todos los armados del pedido {{ $pedido->num_pedido }} que tengas los productos completos. ¿Estás seguro que quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');" title="Asingar rack a los armados">{{ __('Asignar rack') }}</button>
              </div>
            </div>
            {!! Form::close() !!}  
          </div>
          @endcan
        @endif 
      @endif
    </div>
  </div>
  <div class="card-body">
      {!! Form::model(Request::all(), ['route' => [Request::is('produccion/pedido-activo/editar/*') ? 'produccion.pedidoActivo.edit' : 'produccion.pedidoActivo.show', Crypt::encrypt($pedido->id)],'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route(Request::is('produccion/pedido-activo/editar/*') ? 'produccion.pedidoActivo.edit' : 'produccion.pedidoActivo.show', Crypt::encrypt($pedido->id)), 'opciones_buscador' => config('opcionesSelect.select_produccion_pedido_armados_index')])
    {!! Form::close() !!}
    @include('produccion.pedido.pedido_activo.armado_activo.armAct_table')
    @include('global.paginador.paginador', ['paginar' => $armados])
  </div>
</div>