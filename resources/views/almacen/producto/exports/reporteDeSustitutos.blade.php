<table>
    <thead>
    <tr>
      <th>COD</th>
      <th>ARMADO</th>
      <th>CANTIDAD ARMADO</th>
      <th>ID_PRODUCTO</th>
      <th>CANTIDAD PRODUCTO</th>
      <th>PRODUCTO ORIGINAL</th>
      <th>ID_PRODUCTO_SUSTITUTO</th>
      <th>CANTIDAD SUSTITUTO</th>
      <th>PRODUCTO SUSTITUTO</th>
      <th>FECHA REGISTRO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $producto)
      <tr>
          {{--  <td>{{ $productos }}</td>  --}}
          {{--  armado  --}}
            <td>{{ $producto->cod }}</td>
            <td>{{ $producto->nom }}</td>
            <td>{{ $producto->ACant }}</td>

          {{--  productos de ese armado que fueron sustituidos --}}
            <td>{{ $producto->id_producto }}</td>
            <td>{{ $producto->PACant }}</td>
            <td>{{ $producto->produc }}</td>  

            {{--  productos que sustituyen a los originales  --}}
            <td>{{ $producto->id_PSustituto }}</td>
            <td>{{ $producto->CSustituto }}</td>
            <td>{{ $producto->PSustituto }}</td>
            <td>{{ $producto->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>