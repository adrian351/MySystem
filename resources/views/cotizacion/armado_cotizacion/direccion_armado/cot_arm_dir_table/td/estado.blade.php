<td>
  {{ $direccion->est }}
  @if($direccion->est == 'Tarifa única ')
    @if($direccion->ciudad != 'Tarifa única ')
      ({{ $direccion->ciudad }})
    @endif
  @endif
</td>