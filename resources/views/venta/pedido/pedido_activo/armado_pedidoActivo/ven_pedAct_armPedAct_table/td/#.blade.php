<td id="codigo_a" title="Da click en el código para ver los detalles del armado">
  @if($show == true)
    @canany($canany)
      <a href="{{ route($ruta, Crypt::encrypt($armado->id)) }}" title="Detalles: {{ $armado->cod }}">{{ $armado->cod }}</a>
    @else
      {{ $armado->cod }}
    @endcanany
  @else
    {{ $armado->cod }}
  @endif

  {{--  @if($armado->for_loc == config('opcionesSelect.select_foraneo_local.Foráneo'))  --}}
  @if($armado->for_loc == 'Foráneo')
    <i class="fas fa-globe-africa" title="{{ __('Foráneo') }}"></i><br/>
    @else
      <i class="fas fa-street-view" title="Local"></i>
  @endif
</td>
@if(Request::route()->getName() == 'rolCliente.pedido.show')
@section('js5')
<script>
  $('#codigo_a').tooltip('show');
</script>
@endsection
@endif