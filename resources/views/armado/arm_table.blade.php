<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
          <th>{{ __('SKU') }}</th>
          <th>{{ __('NOMBRE') }}</th>
          <th>{{ __('STOCK') }}</th>
          <th>{{ __('PRECIO REDONDEADO') }}</th>
          <th>{{ __('MARCA') }}</th>
          <th>{{ __('GAMA') }}</th>
          <th colspan="3">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($armados as $armado)
          <tr title={{ $armado->sku }}>
            <td>AC-{{$armado->id }}</td>
            <td>{{ $armado->sku  }}</td>
            <td>
              @if(Request::route()->getName() == 'armado.index')
                @include('armado.arm_tableOpcionShow') 
              @elseif(Request::route()->getName() == 'armado.clon.index')
                @include('armado.clon_armado.arm_cloArm_tableOpcionShow') 
              @endif
            </td>
            <td>{{ $armado->stock }}</td>
            <td>${{ Sistema::dosDecimales($armado->prec_redond) }}</td>
            <td>
              @foreach ($armado->marca as $marca)
                {{ $marca->marca }}
              @endforeach
            </td>
            <td>{{ $armado->gama  }}</td>
            @if(Request::route()->getName() == 'armado.index')
              @include('armado.arm_tableOpciones') 
            @elseif(Request::route()->getName() == 'armado.clon.index')
              @include('armado.clon_armado.arm_cloArm_tableOpciones')
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