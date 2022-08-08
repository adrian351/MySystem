{{--  <td>{{ $pedido->fecha_de_entrega =  date('d-m-Y', strtotime($pedido->fech_de_entreg)) }}</td>  --}}
{{--  <td>{{ $pedido->fech_de_entreg}}</td>  --}}
{{--  <td></td>  --}}
@if ($pedido->fech_de_entreg == null)
    <td></td>
@else
    <td>{{ date('d-m-Y', strtotime($pedido->fech_de_entreg)) }}</td>
@endif

