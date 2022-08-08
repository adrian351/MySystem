<td>
  @if($show == true)
    @canany($canany)
      <a href="{{ route($ruta, Crypt::encrypt($costo_de_envio->id)) }}" title="Detalles: {{ $costo_de_envio->id }}">{{ $costo_de_envio->id }}</a>
    @else
      {{ $costo_de_envio->id }}
    @endcanany
  @else
    {{ $costo_de_envio->id }}
  @endif
</td>