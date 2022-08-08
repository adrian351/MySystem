@php 
  $cant_direcciones3 += $direccion->cant
@endphp
@if($direccion->est == 'Jalisco (Guadalajara)' OR $direccion->est == 'Guanajuato (Guanajuato)' OR $direccion->est == 'Guerrero (Chilpancingo de los Bravo)' OR $direccion->est == 'Veracruz de Ignacio de la Llave (Xalapa de Enríquez)')
  @if($direccion->tip_env == 'Consolidado' OR $direccion->tip_env == 'Directo')
    @if($armado->sub_total >= 50000.00)
      @if($cant_direcciones3 == $armado->cant)
        <tr>
          <td>
            <strong>
              <h5>{{ $armado->nom }} {{ __('ESTE ARCÓN ES MERECEDOR A QUE EL ENVIO SEA GRATIS ($50,000.00)') }}</h5>
            </strong>
          </td>
        </tr>
      @endif
    @endif
  @endif
@endif