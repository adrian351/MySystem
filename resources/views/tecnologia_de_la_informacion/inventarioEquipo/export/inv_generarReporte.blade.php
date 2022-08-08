<table >
  <thead>
    <tr>
      <th>FECHA DE REGISTRO</th>
      <th>ID EQUIPO</th>
      <th>RESPONSABLE</th>
      <th>EMPRESA</th>
      <th>MARCA</th>
      <th>MODELO</th>
      <th>NUM. SERIE</th>
      <th>ULTIMO MANTENIMIENTO</th>
      <th>PROXIMO MANTENIMIENTO</th>
      <th>DESCRIPCIÓN DEL EQUIPO</th>
      <th>OBSERVACIONES</th>
    </tr>
  </thead>
  <tbody>
    @foreach($equipos as $inventario)
      <tr>
        <td>{{ $inventario->created_at }}</td>
        <td>{{ $inventario->id_equipo }}</td>
        <td>{{ $inventario->resp }}</td>
        <td>{{ $inventario->emp }}</td>
        <td>{{ $inventario->mar }}</td>
        <td>{{ $inventario->mod }}</td>
        <td>{{ $inventario->num_ser }}</td>
        <td>{{ $inventario->ult_fec_de_man }}</td>
        <td>{{ $inventario->prox_fec_de_man }}</td>
        <td>{{ $inventario->des_del_equ }}</td>
        <td>{{ $inventario->obs }}</td>
      </tr>
    @endforeach
  </tbody>
</table>