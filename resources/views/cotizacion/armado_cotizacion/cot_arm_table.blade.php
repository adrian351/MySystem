<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 30em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          @if ($cotizacion->estat == "Aprobada")
            <th>{{ __('ID') }}</th>
            <th>{{ __('SKU') }}</th>
            <th>{{ __('TIPO') }}</th>
            <th>{{ __('DESCRIPCIÓN') }}</th>
            <th>{{ __('CANT.') }}</th>
            <th>{{ __('PRECIO COM.') }}</th>
            <th>{{ __('PRECIO UNIT.') }}</th>
            <th>{{ __('DESCUENTO') }}</th>
            <th>{{ __('COST. ENVIO') }}</th>
            <th>{{ __('SUBTOTAL') }}</th>
            <th>{{ __('IVA') }}</th>
            <th>{{ __('TOTAL') }}</th>

            <th class="bg-success">{{ __('PRECIO UNIT.') }}</th>
            <th class="bg-success">{{ __('SUBTOTAL') }}</th>
            <th class="bg-success">{{ __('DESCUENTO') }}</th>
            <th class="bg-success">{{ __('IVA') }}</th>
            <th class="bg-success">{{ __(' TOTAL') }}</th>
            <th colspan="3">&nbsp</th>
          @else
            {{-- ID DEL ARMADO   --}}
            <th>{{ __('ID') }}</th>
            {{-- Sku del armado --}}
            <th>{{ __('SKU') }}</th>
            <th>{{ __('TIPO') }}</th>
            <th>{{ __('DESCRIPCIÓN') }}</th>
            <th>{{ __('CANT.') }}</th>
            <th>{{ __('PRECIO COM.') }}</th>
            <th>{{ __('PRECIO UNIT.') }}</th>
            <th>{{ __('DESCUENTO') }}</th>
            <th>{{ __('COST. ENVIO') }}</th>
            <th>{{ __('SUBTOTAL') }}</th>
            <th>{{ __('IVA') }}</th>
            <th>{{ __('TOTAL') }}</th>
            <th colspan="3">&nbsp</th>
          @endif
        </tr>
      </thead>
      <tbody> 
        @foreach($armados as $armado)
          <tr title="{{ $armado->nom }}">
            {{-- ID del armado:AC--}}
            <td>
              AC-{{ $armado->id_armado }}
            </td>
            <td>
              {{ $armado->sku }}
            </td>
            <td>
              @can('cotizacion.show')
                <a href="{{ route('cotizacion.armado.show', Crypt::encrypt($armado->id)) }}" title="Detalles: {{ $armado->tip }}">{{ $armado->tip }}</a>
              @else
                {{ $armado->tip }}
              @endcan

              @if($armado->cant == $armado->cant_direc_carg)
                <i class="fas fa-check ml-1"></i>
              @endif

              @if($armado->es_de_regalo == 'Si')
                <i class="fas fa-gift text-info ml-2" title="{{ __('Gratis') }}"></i>
              @endif

              @if($armado->es_de_stock == 'Si')
                <i class="fas fa-store text-success ml-2" title="Es de stock"></i>
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
                        {{ $producto->cant }} - {{ $producto->produc }} (${{ Sistema::dosDecimales($producto->prec_clien) }})
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </td>
            @if ($cotizacion->estat == "Aprobada")
              <td width="1rem">{{ Sistema::dosDecimales($armado->cant) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->prec_de_comp) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->prec_redond) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->desc) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->cost_env) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->sub_total) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->iva) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->tot) }}</td>

              <td width="1rem" class="bg-dark">${{ Sistema::dosDecimales($armado->prec_cot) }}</td>
              <td width="1rem" class="bg-dark">${{ Sistema::dosDecimales($armado->sub_tot_cot) }}</td>
              <td width="1rem" class="bg-dark">${{ Sistema::dosDecimales($armado->desc_cot) }}</td>
              <td width="1rem" class="bg-dark">${{ Sistema::dosDecimales($armado->iva_cot) }}</td>
              <td width="1rem" class="bg-dark">${{ Sistema::dosDecimales($armado->tot_cot) }}</td>
            @else
            
              <td width="1rem">{{ Sistema::dosDecimales($armado->cant) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->prec_de_comp) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->prec_redond) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->desc) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->cost_env) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->sub_total) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->iva) }}</td>
              <td width="1rem">${{ Sistema::dosDecimales($armado->tot) }}</td>
            @endif
            
            @if(Request::route()->getName() == 'cotizacion.edit')
              @include('cotizacion.armado_cotizacion.cot_arm_tableOpciones')
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