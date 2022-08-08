<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pedidos) == 0)
      @include('layouts.private.busquedaSinResultados', ['mensaje' => 'Sin resultados'])
    @else 
      <thead>
        <tr>
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.numeroDePedido')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.fechaDeEntrega')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.totalDeArmados')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusPago')
          @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusLogistica')
          {{-- @include('venta.pedido.pedido_activo.ven_pedAct_table.th.estatusProduccion') --}}
          <th colspan="2" class="text-center">
            {{ __('COMPROBANTES') }}
          </th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pedidos as $pedido)
          <tr title="{{ $pedido->num_pedido }}">
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.numeroDePedido')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.fechaDeEntrega')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.totalDeArmados')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago')
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusLogistica')
            {{-- @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusProduccionCliente') --}}
            <td> 
              {{--  @foreach ($pedido->armados as $arm)
                @foreach ($arm->direcciones as $dir)
                  @if ($dir->comp_de_sal_rut == null )
                      
                    @else
                      <div class="card py-1 px-1 shadow-md" style="width: 2rem; float: left; margin: 1rem;">
                        <a href="{{$dir->comp_de_sal_rut.$dir->comp_de_sal_nom}}" title="Ver">
                          <img src="{{ $dir->comp_de_sal_rut.$dir->comp_de_sal_nom}}" class="card-img-top" />
                        </a>  
                      </div> 
                  @endif
                @endforeach
              @endforeach  --}}
              <div class="card">
                <div class="card-header p-0 m-0" id="k{{ $pedido->id }}">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#z{{ $pedido->id }}" aria-expanded="false" aria-controls="z{{ $pedido->id }}">
                      <strong>Salida</strong>
                    </button>
                  </h5>
                </div>
                <div id="z{{ $pedido->id }}" class="collapse" aria-labelledby="k{{ $pedido->id }}">
                  <div class="card-body p-1">
                    @foreach ($pedido->armados as $arm)
                      @foreach ($arm->direcciones as $dir)
                        <div class="input-group text-muted ml-1">
                          <div class="card">
                            <div class="card-body p-2">
                              @if ($dir->comp_de_sal_nom == null || $dir->comp_de_sal_nom == '')
                                <strong>{{ $dir->cod}}&nbsp;&nbsp;&nbsp; <b><i class="fas fa-times"></i> {{ __('Sin resultados') }}</b></strong>
                                @else 
                                  <strong>{{ $dir->cod}}</strong>&nbsp;
                                  <strong>{{ $dir->est}}</strong>&nbsp;
                                  <strong>{{ $dir->del_o_munic}}</strong>&nbsp;
                                  <a href="{{$dir->comp_de_sal_rut.$dir->comp_de_sal_nom}}" title="Ver Comprobante" class="i btn btn-light btn-sm">
                                    <i class="fas fa-image"></i>
                                  </a>
                              @endif 
                            </div> 
                          </div>
                        </div>
                      @endforeach
                    @endforeach
                  </div>
                </div>
              </div>  
            </td>
            <td> 
              <div class="card">
                <div class="card-header p-0 m-0" id="v{{ $pedido->id }}">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#a{{ $pedido->id }}" aria-expanded="false" aria-controls="a{{ $pedido->id }}">
                      <strong>Entrega</strong>
                    </button>
                  </h5>
                </div>
                <div id="a{{ $pedido->id }}" class="collapse" aria-labelledby="v{{ $pedido->id }}">
                  <div class="card-body p-1">
                    @foreach ($pedido->armados as $arm)
                      @foreach ($arm->direcciones as $dir)
                        <div class="input-group text-muted ml-1">
                          <div class="card">
                            <div class="card-body p-2">
                              @if (count($dir->comprobantes) == 0)
                                <strong>{{ $dir->cod}}&nbsp;&nbsp;&nbsp;<b><i class="fas fa-times"></i> {{ __('Sin resultados') }}</b></strong>
                                @else
                                  @foreach ($dir->comprobantes as $c) 
                                    <strong>{{ $dir->cod}}</strong>&nbsp;
                                    <strong>{{ $dir->est}}</strong>&nbsp;
                                    <strong>{{ $dir->del_o_munic}}</strong>&nbsp;
                                      <a href="{{$c->comp_ent_rut.$c->comp_ent_nom}}" title="Ver Comprobante" class="i btn btn-light btn-sm">
                                        <i class="fas fa-image"></i>
                                      </a>
                                  @endforeach
                              @endif
                            </div> 
                          </div>
                        </div>
                      @endforeach
                    @endforeach
                  </div>
                </div>
              </div>          
            </td>
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>