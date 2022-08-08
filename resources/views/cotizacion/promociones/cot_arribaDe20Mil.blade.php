@php 
  $cant_direcciones2 += $direccion->cant
@endphp
@if($direccion->est == 'Querétaro (Santiago de Querétaro)' OR $direccion->est == 'Puebla (H. Puebla de Zaragoza)' OR $direccion->est == 'Hidalgo (Pachuca de Soto)' OR $direccion->est == 'Tlaxcala (Tlaxcala de Xicohténcatl)' OR $direccion->est == 'Morelos (Cuernavaca)' OR $direccion->est == 'México (Edo. México)')
  @if($direccion->tip_env == 'Consolidado' OR $direccion->tip_env == 'Directo')
    @if($armado->sub_total >= 20000.00)
      @if($cant_direcciones2 == $armado->cant)
        <tr>
          <td>
            <strong>
              <h5>{{ $armado->nom }} {{ __('ESTE ARCÓN ES MERECEDOR A QUE EL ENVIO SEA GRATIS ($20,000.00)') }}</h5>
            </strong>
          </td>
        </tr>
      @endif
    @endif
  @endif
@endif