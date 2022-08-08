<table>
  <thead>
  <tr>
    <th>NOMBRE DEL PRODUCTO</th>
    <th>CANTIDAD</th>
  </tr>
  </thead>
  <tbody>
  @foreach($pedidos as $pedido)
  <tr>
    <td>{{ $pedido['nombre_producto'] }}</td>
    <td>{{ $pedido['cantidad'] }}</td>
  </tr>
  @endforeach
  </tbody>
</table>