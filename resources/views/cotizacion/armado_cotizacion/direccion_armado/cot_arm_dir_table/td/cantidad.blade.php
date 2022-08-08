<td id="direccion_cli" title="Da click en la cantidad para ver los detalles de la dirección">
  @if($show == true)
    @canany($canany)
      <a href="{{ route($ruta, Crypt::encrypt($direccion->id)) }}" title="Detalles: {{ $direccion->est }}" {{ $target }}>{{ Sistema::dosDecimales($direccion->cant) }}</a>
    @else
    {{ Sistema::dosDecimales($direccion->cant) }}
    @endcanany
  @else
    {{ Sistema::dosDecimales($direccion->cant) }}
  @endif

  @if($direccion->for_loc == 'Foráneo')
    <i class="fas fa-globe-africa" title="{{ __('Foráneo') }}"></i>
    @else
    <i class="fas fa-street-view" title="{{ __('Local') }}"></i>
  @endif
</td>

@if(Request::route()->getName() == 'rolCliente.pedido.armado.show')
@section('js5')
<script>
  $('#direccion_cli').tooltip('show');
</script>
@endsection
@endif