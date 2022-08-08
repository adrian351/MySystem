<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($productos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr> 
          <th>{{ __('ID') }}</th>
          <th>{{ __('SKU') }}</th>
          <th>{{ __('CANTIDAD') }}</th>
          <th>{{ __('PRODUCTO') }}</th>
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($productos as $producto)
          <tr title="{{ $producto->sku }}">
            <td width="1rem">{{ $producto->id }}</td>
            <td>{{ $producto->sku }}</td>
            <td>{{ $producto->cant }}</td>
            <td>{{ $producto->produc }}</td>
            @include('almacen.pedido.pedido_activo.armado_activo.productos_armado.alm_pedAct_armAct_proAct_tableOpciones')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>