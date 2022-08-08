<table>
  <thead>
  <tr>
    <th>ID</th>
    <th>GAMA</th>
    <th>IMAGEN</th>
    <th>ARMADO</th>
    <th>PRECIO + IVA</th>
    <th>PRODUCTOS</th>
  </tr>
  </thead>
  <tbody>
  @foreach($armados as $armado)
    <tr>
      <td>{{ $armado->id }}</td>
      <td>{{ $armado->gama }}</td>
      <td>
        @if($armado->img_nom != null)
        {{--   <img src="{{ $armado->img_rut.$armado->img_nom }}" style="width:1rem;"> --}}
        @endif
      </td>
      <td>({{ $armado->sku }}) {{ $armado->nom }} </td>
      <td>{{ $armado->prec_redond }}</td>
      <td>
        @foreach($armado->productos as $producto)
          + {{ $producto->cant }} - {{ $producto->produc }}<br>
        @endforeach
      </td>
    </tr>
  @endforeach
  </tbody>
</table>