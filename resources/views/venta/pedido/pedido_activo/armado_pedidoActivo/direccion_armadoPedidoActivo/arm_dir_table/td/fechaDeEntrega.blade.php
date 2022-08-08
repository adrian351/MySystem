@if ($direccion->armado->pedido->fech_de_entreg == null)
    <td></td>
    @else
    <td>{{ date('d-m-Y', strtotime($direccion->armado->pedido->fech_de_entreg)) }}</td>

@endif
