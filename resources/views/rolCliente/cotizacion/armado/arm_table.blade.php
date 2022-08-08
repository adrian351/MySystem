<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 30em;">
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
      @if(sizeof($armados) == 0)
        @include('layouts.private.busquedaSinResultados')
      @else 
        <thead>
          <tr>
            <th>{{ __('TIPO') }}</th>
            <th>{{ __('DESCRIPCIÓN') }}</th>
            <th>{{ __('CANT.') }}</th>
            <th>{{ __('PRECIO UNIT.') }}</th>
            @if($cotizacion->desc > 0)
              <th>{{ __('DESCUENTO') }}</th>
            @endif
            <th>{{ __('COST. ENVIO') }}</th>
            <th>{{ __('SUBTOTAL') }}</th>
            <th>{{ __('IVA') }}</th>
            <th>{{ __('TOTAL') }}</th>
          </tr>
        </thead>
        <tbody> 
          @foreach($armados as $armado)
            <tr title="{{ $armado->nom }}">
              <td>
                @can('cotizacion.show')
                  <a href="{{ route('cotizacion.armado.show', Crypt::encrypt($armado->id)) }}" title="Detalles: {{ $armado->tip }}">{{ $armado->tip }}</a>
                @else
                  {{ $armado->tip }}
                @endcan
  
                @if($armado->cant == $armado->cant_direc_carg)
                  <i class="fas fa-check"></i>
                @endif
  
                @if($armado->es_de_regalo == 'Si')
                  <i class="fas fa-gift" title="{{ __('Gratis') }}"></i>
                @endif
              </td>
              <td>
                <div class="card">
                  <div class="card-header p-0 m-0" id="h{{ $armado->id }}">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#a{{ $armado->id }}" aria-expanded="false" aria-controls="a{{ $armado->id }}">
                        <strong>{{ $armado->nom }} ({{ $armado->sku }})</strong>
                      </button>
                    </h5>
                  </div>
                  <div id="a{{ $armado->id }}" class="collapse" aria-labelledby="h{{ $armado->id }}">
                    <div class="card-body p-1">
                      @foreach($armado->productos as $producto)
                        <div class="input-group text-muted ml-4">
                          {{ $producto->cant }} - {{ $producto->produc }}
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </td>
              <td width="1rem">{{ Sistema::dosDecimales($armado->cant) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->prec_redond) }}</td>
              @if($cotizacion->desc > 0)
                <td width="1rem">${{ Sistema::dosDecimales($armado->desc) }}</td>
              @endif
              <td width="1rem">${{ Sistema::dosDecimales($armado->cost_env) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->sub_total) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->iva) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->tot) }}</td>
            </tr>
            @endforeach
        </tbody>
      @endif
    </table>
  </div>