<table>
  <thead>
  <tr>
    <th>ID</th>
    <th>FECHA</th>
    <th>PRODUCTO</th>
    <th>CORREO</th>
    <th>ACCIÓN</th>
    <th>STOCK ANTERIOR</th>
    <th>STOCK NUEVO</th>
    <th>DIFERENCIA</th>
  </tr>
  </thead>
  <tbody>
  @foreach($registros as $registro)
    <tr>
      <td>{{ $registro->id }}</td>
      <td>{{ $registro->created_at }}</td>
      <td>{{ $registro->reg }}</td>
      <td>{{ $registro->email_usuario }}</td>
      <td>{{ $registro->acc }}</td>
      <td>{{ $registro->stock_ant }}</td>
      <td>{{ $registro->stock_nuev }}</td>
      <td>{{ $registro->dif }}</td>
    </tr>
  @endforeach
  </tbody>
</table>