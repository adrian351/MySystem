@php 
  $cant_direcciones1 += $direccion->cant
@endphp
@if($direccion->est == 'Ciudad de México (Ciudad de México)' OR $direccion->est == 'México (Edo. México)')
  @if($direccion->met_de_entreg != 'Viaje metropolitano (Uber, Didi, Beat...)' AND $direccion->met_de_entreg != 'Entregado en bodega naucalpan')
    @if($direccion->tip_env != 'Paquetería')
      @if($armado->sub_total >= 4000.00)
        @if($cant_direcciones1 == $armado->cant)
        <tr>
          <td>
            <strong>
              <h5>{{ $armado->nom }} {{ __('ESTE ARCÓN ES MERECEDOR A QUE EL ENVIO SEA GRATIS ($4,000.00)') }}</h5>
            </strong>
          </td>
        </tr>
        @endif
      @endif
    @endif
  @endif
@endif