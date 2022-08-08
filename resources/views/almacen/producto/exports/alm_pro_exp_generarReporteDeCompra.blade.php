<table>
  <thead>
  <tr>
    <th>ID</th>
    <th>NOMBRE DEL PRODUCTO</th>
    <th>SKU</th>
    <th>VENDIDOS</th>
    <th>FECHA VENDIDO</th>
    {{--  <th>PRECIO</th>  --}}
    {{--  <th>CANTIDAD VENDIDA</th>  --}}
    {{--  <th>STOCK</th>
    <th>EXISTENCIA EQUIVALENTE</th>
    <th>ARMADOS</th>  --}}
  </tr>
  </thead>
  <tbody>
  @foreach($productos as $producto)
    <tr>
      <td>{{ $producto['id'] }}</td>
      <td>{{ $producto['nombre_producto'] }}</td> 
      <td>{{ $producto['sku'] }}</td>
      {{--  <td>{{ $producto['precio'] }}</td>  --}}
      <td>{{ $producto['cantidad'] }}</td>
      <td>{{ $producto['fecha'] }}</td>
      {{--  <td>{{ $producto->id }}</td>
      <td>{{ $producto->produc }}</td>
      <td>{{ $producto->prec_clien }}</td>
      <td>{{ $producto->vend }}</td>
      <td>{{ $producto->stock }}</td>
      <td>
        @foreach($producto->sustitutos as $sustituto)
          {{ $sustituto->produc }} - ({{ $sustituto->stock }})<br>
        @endforeach
      </td>
      <td>
        @foreach($producto->productos_pedido as $producto_pedido)
          @if($producto_pedido->armado != null)

            @if($producto_pedido->armado->estat == config('app.pendiente') OR $producto_pedido->armado->estat == config('app.en_espera_de_compra') OR $producto_pedido->armado->estat == config('app.en_revision_de_productos'))
            @else
              [Ent]
            @endif
          
            ({{ $producto_pedido->armado->cod }}) - {{ $producto_pedido->armado->cant * $producto_pedido->cant }}<br>

          @endif
        @endforeach
      </td>  --}}
    </tr>
  @endforeach
  </tbody>
</table>