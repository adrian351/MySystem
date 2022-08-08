<div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 25em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr >
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.#')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.estatus')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.cantidad')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.regalo')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.es_de_stock')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.tipo')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.armado')
          @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.direcciones')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($armados as $armado)
          <tr title="{{ $armado->cod }}">
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.#', ['show' => true, 'canany' => ['venta.pedidoActivo.armado.show', 'venta.pedidoActivo.show'], 'ruta' => 'venta.pedidoActivo.armado.show'])
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.estatus')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.cantidad')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.regalo')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.es_de_stock')
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.tipo')
            {{--  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.armado')  --}}
            {{--  editar tarjeta de felicitación  --}}
            <td>
              <div class="card">
                  <div class="card-header p-0 m-0" id="v{{ $armado->id }}">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#a{{ $armado->id }}" aria-expanded="false" aria-controls="a{{ $armado->id }}">
                        <strong>{{ $armado->nom }} ({{ $armado->sku }})</strong>
                      </button>
                    </h5>
                  </div>
                  <div id="a{{ $armado->id }}" class="collapse" aria-labelledby="v{{ $armado->id }}">
                      <div class="card-body p-1">
                        @if (Request::route()->getName() == 'venta.pedidoActivo.edit')
                          @foreach ($armado->direcciones as $direccion)
                            <div class="input-group text-muted ml-1">
                                <div class="card">
                                    <div class="card-header p-0 m-0" id="d{{ $direccion->cod }}">
                                        <button class="btn">
                                          <strong>{{ $direccion->cod }}[{{ $direccion->cant }}]</strong>
                                          @can('venta.pedidoActivo.armado.edit')
                                            <a href="{{ route('venta.pedidoActivo.armado.direccion.edit', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm' title="Editar dirección">
                                              <i class="fas fa-edit"></i>
                                            </a>
                                          @endcan
                                        </button>
                                    </div>
                                </div>
                            </div>
                          @endforeach 
                        @endif
                    </div>
                  </div>
              </div>
            </td>
            @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.direcciones')
            @if(Request::route()->getName() == 'venta.pedidoActivo.edit')
              @include('venta.pedido.pedido_activo.armado_pedidoActivo.vev_arm_pedAct_tableOpciones')
            @else
              <td width="1rem"></td>
              <td width="1rem"></td>
            @endif
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>