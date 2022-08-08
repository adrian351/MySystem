@php 
  $cant_direcciones4 += $direccion->cant
@endphp
@if($direccion->est == 'Nuevo León (Monterrey)' OR $direccion->est == 'Tamaulipas (Ciudad Victoria)' OR $direccion->est == 'Oaxaca (Oaxaca de Juárez)' OR $direccion->est == 'Durango (Victoria de Durango)' OR $direccion->est == 'San Luis Potosí (San Luis Potosí)' OR $direccion->est == 'Colima (Colima)' OR $direccion->est == 'Zacatecas (Zacatecas)')
  @if($direccion->tip_env == 'Consolidado' OR $direccion->tip_env == 'Directo')
    @if($armado->sub_total >= 70000.00)
      @if($cant_direcciones4 == $armado->cant)
        <tr>
          <td>
            <strong>
              <h5>{{ $armado->nom }} {{ __('ESTE ARCÓN ES MERECEDOR A QUE EL ENVIO SEA GRATIS ($70,000.00)') }}</h5>
            </strong>
          </td>
        </tr>
      @endif
    @endif
  @endif
@endif