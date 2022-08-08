<table>
    <thead>
    <tr>
      <th>ID</th>
      <th>PRODUCTO</th>
      <th>STOCK-NAUCALPAN</th>
      <th>STOCK-TEMAS</th>
      <th>CATEGORIA</th>
      <th>SUB-CATEGORIA</th>
      <th>ETIQUETA</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $producto)
      <tr>
        <td>{{ $producto->id }}</td>
        <td>{{ $producto->produc }}</td>
        <td>{{ $producto->stock }}</td>
        <td>{{ $producto->stock_temas }}</td>
        <td>
            @foreach ($producto->categoria as $cat)
                {{ $cat->categoria }}
            @endforeach
        </td>
        <td>
          @foreach ($producto->subcategoria as $subcat)
              {{ $subcat->subcategoria }}
          @endforeach
        </td>
        <td>
            @foreach ($producto->etiqueta as $e)
                {{ $e->etiqueta."," }}
            @endforeach
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>