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
            @include('almacen.producto.alm_pro_table.th.proveedor')
            @include('almacen.producto.alm_pro_table.th.precioProveedor')
            @include('almacen.producto.alm_pro_table.th.precioCliente')
            {{--  @include('almacen.producto.alm_pro_table.th.categoria')
            @include('almacen.producto.alm_pro_table.th.etiqueta')  --}}
            @include('almacen.producto.alm_pro_table.th.existenciaEquivalente')
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
              @include('almacen.producto.alm_pro_table.td.producto', ['id_producto' => Crypt::encrypt($producto->id), 'target' => '_blank'])
              @include('almacen.producto.alm_pro_table.td.stock')
              @include('almacen.producto.alm_pro_table.td.proveedor')
              @include('almacen.producto.alm_pro_table.td.precioProveedor')
              @include('almacen.producto.alm_pro_table.td.precioCliente')
              @include('almacen.producto.alm_pro_table.td.categoria')
              @include('almacen.producto.alm_pro_table.td.etiqueta')
              @include('almacen.producto.alm_pro_table.td.existenciaEquivalente')
            </tr>
            @endforeach
        </tbody>
      @endif
    </table>
  </div>