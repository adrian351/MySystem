<td width="1rem">
    @php $suma = 0 @endphp
    @foreach($producto->sustitutos as $sustituto)
      @php $suma += $sustituto->stock @endphp
    @endforeach
    {{ Sistema::dosDecimales($suma) }}
  </td>