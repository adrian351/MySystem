<td width="1rem">
  @can('qys.show')
    <a href="{{ route('qys.show', Crypt::encrypt($queja_y_sugerencia->id)) }}" title="Detalles: {{ $queja_y_sugerencia->id }}">{{ $queja_y_sugerencia->id }}</a>
  @else
    {{ $queja_y_sugerencia->id }}
  @endcan
</td>