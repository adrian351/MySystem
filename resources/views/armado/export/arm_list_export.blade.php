<table>
    <thead>
    <tr>
      <th>ID</th>
      <th>ARMADO</th>
      <th>SKU</th>
      <th>PRECIO + IVA</th>
      <th>MARCA</th>
      <th>PRODUCTOS</th>
    </tr>
    </thead>
    <tbody>
    @foreach($armados as $armado)
      <tr>
        <td>{{ $armado->id }}</td>
        <td>{{ $armado->nom }}</td>
        <td>{{ $armado->sku }}</td>
        <td>{{ $armado->prec_redond }}</td>
        <td>
            @foreach ($armado->marca as $marca)
                {{ $marca->marca}}
            @endforeach
        </td>
        <td>
          @foreach($armado->productos as $producto)
            - {{ $producto->produc }}<br>
          @endforeach
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>