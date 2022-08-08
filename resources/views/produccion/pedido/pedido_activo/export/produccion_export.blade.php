<table>
    <thead>
    <tr>
      <th>NUM. PEDIDO</th>
      <th>PEDIDO UNIFICADO</th>
      <th>FECHA ENTREGA</th>
      <th>ESTATUS PRODUCCIÓN</th>
      <th>BODEGA</th>
      <th>TOTAL ARMADOS</th>
    </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->num_pedido }}</td>
            <td>
                @foreach ($pedido->unificar as $unificado)
                   [{{ $unificado->num_pedido }}]
                @endforeach
            </td>
            <td>{{ date('d-m-Y', strtotime($pedido->fech_de_entreg)) }}</td>
            <td>{{ $pedido->estat_produc }}</td>
            <td>{{ $pedido->bod }}</td>
            <td>{{ $pedido->tot_de_arm }}</td>
        </tr>
        @endforeach
    </tbody>
</table>