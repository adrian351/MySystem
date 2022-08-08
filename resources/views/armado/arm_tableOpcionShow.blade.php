@can('armado.show')
  <a href="{{ route('armado.show', Crypt::encrypt($armado->id)) }}" title="Detalles: {{ $armado->sku }}">{{ $armado->nom  }}</a>
@else
  {{ $armado->nom  }}
@endcan