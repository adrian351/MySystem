<td>
  @if($show == true)
    @canany($canany)
      <a href="{{ route($ruta, Crypt::encrypt($direccion->armado->id)) }}" title="Detalles: {{ $direccion->armado->cod }}" {{ $target }}>{{ $direccion->armado->cod }}</a>
    @else
      {{ $direccion->armado->cod }}
    @endcanany
  @else
    {{ $direccion->armado->cod }}
  @endif

  @if($direccion->regresado == 'verdadero')
    <i class="fas fa-undo-alt" title="Armado regresado a producción"></i>
  @endif
</td>