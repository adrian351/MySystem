<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($productos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr> 
          @include('almacen.producto.alm_pro_table.th.sku')
          @include('almacen.producto.alm_pro_table.th.producto')
          @include('almacen.producto.alm_pro_table.th.stock')
          <th>{{ 'STOCK TEMAS' }}</th>
          <th>{{ 'ID - ARMADO QUE TIENE ESE PRODUCTO' }}</th>
          @include('almacen.producto.alm_pro_table.th.proveedor')
          @include('almacen.producto.alm_pro_table.th.precioProveedor')
          @include('almacen.producto.alm_pro_table.th.precioCliente')
          @include('almacen.producto.alm_pro_table.th.categoria')
          @include('almacen.producto.alm_pro_table.th.existenciaEquivalente')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($productos as $producto)
          @php
            $estilos = null;
            $clase = null; 
          @endphp
      
          @if($producto->stock < $producto->min_stock)
            @php
              $clase = 'bg-warning'; 
            @endphp
          @endif

          @if($producto->prod_valid == 'No')
            @php
              $estilos .= 'background-color: #ff000060';
            @endphp
          @endif

          <tr title="{{ $producto->sku }}" class="{{ $clase }}" style="{{ $estilos }}">
            @include('almacen.producto.alm_pro_table.td.sku')
            @include('almacen.producto.alm_pro_table.td.producto', ['id_producto' => Crypt::encrypt($producto->id)])
            @include('almacen.producto.alm_pro_table.td.stock')
            <td>{{ $producto->stock_temas }}</td>
            <td>
              @foreach ($producto->armados as $armado)
              {{ $armado->id."," }} 
              @endforeach
            </td>
            @include('almacen.producto.alm_pro_table.td.proveedor')
            @include('almacen.producto.alm_pro_table.td.precioProveedor')
            @include('almacen.producto.alm_pro_table.td.precioCliente')
            {{-- @include('almacen.producto.alm_pro_table.td.categoria') --}}
            <td>
              @foreach ($producto->categoria as $subcat)
                {{ $subcat->categoria }}
              @endforeach
            </td>
            @include('almacen.producto.alm_pro_table.td.existenciaEquivalente')
            @include('almacen.producto.alm_pro_tableOpciones')
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>