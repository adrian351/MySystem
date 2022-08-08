<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 20em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($direcciones) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.#') 
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.nombreDeReferenciaUno')
          {{--  @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.cantidad')  --}}
          <th>{{ __('CANTIDAD') }}</th>
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.estatus')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.metodoDeEntrega')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.estado')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.tipoDeEnvio')
          @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.th.costo')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.th.colonia')
          <th colspan="1">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($direcciones as $direccion)
          <tr title="{{ $direccion->est }}">
            {{--  @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.#')   --}}
            <td>
                @canany('venta.pedidoActivo.armado.show')
                  <a href="{{ route('venta.pedidoActivo.armado.direccion.show', Crypt::encrypt($direccion->id)) }}" title="Detalles: {{ $direccion->est }}">{{ $direccion->cod }}</a>
                @else
                {{ $direccion->cod }}
                @endcanany
              
            
              @if($direccion->for_loc == 'Foráneo')
                <i class="fas fa-globe-africa" title="{{ __('Foráneo') }}"></i>
                @else
                <i class="fas fa-street-view" title="{{ __('Local') }}"></i>
              @endif
            </td>
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.nombreDeReferenciaUno')
            {{--  @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.cantidad', ['show' => true, 'canany' => ['venta.pedidoActivo.armado.show', 'venta.pedidoActivo.show'], 'ruta' => 'venta.pedidoActivo.armado.direccion.show', 'target' => null])  --}}
            <td title="Editar cantidad"> 
              <span>{{ $direccion->cant }}</span>
              {{--  funcional pero comentado por su poco uso  --}}
              {{--  @if(Request::route()->getName() == 'venta.pedidoActivo.armado.edit')
                @can('venta.pedidoActivo.armado.edit')
                <div class="form-inline my-2 my-lg-0 float-right">

                  {!! Form::open(['route' => ['venta.pedidoActivo.armado.direccion.updateCantidad', Crypt::encrypt($direccion->id), Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'ventaPedidoActivoArmadoDireccionUpdateCantidad']) !!}
                    <div class="input-group input-group-sm">
                     
                      {!! Form::text('cantidad_por_direccion',null, ['class' => 'form-control form-control-sm' . ($errors->has('cantidad_por_direccion') ? ' is-invalid' : ''), 'placeholder' => 'Nueva cantidad', 'id' => 'cantidadArmados', 'onchange' => 'this.form.submit()']) !!}
                      {!! Form::close() !!}
                      <span class="text-danger">{{ $errors->first('cantidad_por_direccion') }}</span>

                    </div>
                  {!! Form::close() !!}
                </div>
                @endcan
              @endif  --}}
            </td>
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.estatus')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.metodoDeEntrega')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.estado')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.tipoDeEnvio')
            @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_table.td.costo')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table.td.colonia')
            @if(Request::route()->getName() == 'venta.pedidoActivo.armado.edit')
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_tableOpciones')
            @else
              <td></td>
            @endif
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>
