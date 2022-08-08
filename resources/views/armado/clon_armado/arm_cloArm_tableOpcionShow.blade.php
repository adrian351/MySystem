@can('armado.clon.show')
  <a href="{{ route('armado.clon.show', Crypt::encrypt($armado->id)) }}" title="Detalles: {{ $armado->sku }}">{{ $armado->nom  }}</a>
@else
  {{ $armado->nom  }}
@endcan