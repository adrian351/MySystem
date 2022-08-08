{{--  <div id="producto">
  <div class="card">
      <h5 class="mb-0 p-1">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsePro" aria-expanded="false" aria-controls="collapsePro">
          <i class="fas fa-arrow-right"></i>&nbsp;&nbsp;&nbsp;<b>{{ __('PRODUCTOS DEL ARMADO') }}</b>
        </button>
      </h5>
    <div id="collapsePro" class="collapse"  data-parent="#producto">
      <div class="card-body">  --}}
        {{--  <div class="row">  --}}
          <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;">
            <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
              <thead>
                <tr >
                  <th>{{ __('NOMBRE') }}</th>
                  @if(Request::route()->getName() == 'almacen.pedidoActivo.armado.show')
                    <th>{{ __('STOCK') }}</th>
                  @endif
                </tr>
              </thead>
              <tbody> 
                @foreach($productos as $producto)
                  <tr>
                    <td>
                      {{ $producto->cant }} -
                      @can('almacen.producto.show')
                        <a href="{{ route('almacen.producto.show', Crypt::encrypt($producto->id_producto)) }}" target="_blank">{{ $producto->produc }}</a>
                      @else
                        {{ $producto->produc }}
                      @endcan
                      @foreach($producto->sustitutos as $sustituto)
                        <div class="input-group text-muted ml-4">
                          {{ $sustituto->cant }} -
                          @can('almacen.producto.show')
                            <a href="{{ route('almacen.producto.show', Crypt::encrypt($sustituto->id_producto)) }}" target="_blank">{{ $sustituto->produc }}</a>
                          @else
                            {{ $sustituto->produc }}
                          @endcan
                        </div>
                      @endforeach
                    </td>
                    @if(Request::route()->getName() == 'almacen.pedidoActivo.armado.show')
                      <td>
                        @foreach($producto->productos_original as $producto_original)
                          {{ $producto_original->stock }}
                        @endforeach
                      </td>
                    @endif
                  </tr>
                  @endforeach
        
                  @if(Request::route()->getName() == 'venta.pedidoActivo.armado.show' OR Request::route()->getName() == 'almacen.pedidoActivo.armado.show' OR Request::route()->getName() == 'produccion.pedidoActivo.armado.show')
                    <tr>
                      <td>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td>
                    </tr>
                    @foreach($direcciones as $direccion)
                      <tr>
                        <td>
                          {{ $direccion->cant }} - {{ $direccion->caj }}
                        </td>
                      </tr>
                    @endforeach
                  @endif
                  
              </tbody>
            </table>
          </div>
        {{--  </div>  --}}
      {{--  </div>
    </div>
  </div>
</div>  --}}