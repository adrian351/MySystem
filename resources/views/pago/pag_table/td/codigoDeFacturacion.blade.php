<td id="pago_cli" title="Da click en el código para ver los detalles del pago">
  @if($show == true)
    @canany($canany)
      <a href="{{ route($ruta, Crypt::encrypt($pago->id)) }}" title="Detalles: {{ $pago->cod_fact }}" {{ $target }}>{{ $pago->cod_fact }}</a>
    @else
      {{ $pago->cod_fact }}
    @endcanany
  @else
    {{ $pago->cod_fact }}
  @endif
</td>

@if(Request::route()->getName() == 'rolCliente.pedido.show')
@section('js6')
<script>
  $('#pago_cli').tooltip('show');
</script>
@endsection
@endif