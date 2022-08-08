<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($cotizaciones) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th style="width: 40%"></th>
          @include('cotizacion.cot_table.th.serie')
          @include('cotizacion.cot_table.th.numPedGen')
          @include('cotizacion.cot_table.th.estatus')
          @include('cotizacion.cot_table.th.validez')
          @include('cotizacion.cot_table.th.total')
        </tr>
      </thead>
      <tbody> 
        @foreach($cotizaciones as $cotizacion)
          <tr title="{{ $cotizacion->serie }}">
            <td>
              @if($cotizacion->con_com == 'on')
                <p>
                {{--  href="https://www.paypal.com/paypalme/canastasgfj/{{ Sistema::dosDecimales($cotizacion->tot) }}" target="_blank"  --}}
                <img src="https://s3-us-west-2.amazonaws.com/archivos.arconesycanastas/sistema/5173_conekta.png"class="brand-image elevation-0" style="width:1.5rem;">
                <img src="https://s3-us-west-2.amazonaws.com/archivos.arconesycanastas/sistema/clip.png"class="brand-image elevation-0" style="width:1.5rem;">
                  <cite>Para pago con tarjeta solicíta el link de pago, comisión incluida del</cite> 5%: <b>${{ Sistema::dosDecimales($cotizacion->tot) }}</b>
                </p>
              @else
                {{-- https://www.paypal.me/canastasyarcones/ --}}
                <p> 
                {{--  href="https://www.paypal.com/paypalme/canastasgfj/{{ Sistema::dosDecimales($cotizacion->tot*1.05) }}" target="_blank"  --}}
                <img src="https://s3-us-west-2.amazonaws.com/archivos.arconesycanastas/sistema/5173_conekta.png"class="brand-image elevation-0" style="width:1.5rem;">
                <img src="https://s3-us-west-2.amazonaws.com/archivos.arconesycanastas/sistema/clip.png"class="brand-image elevation-0" style="width:1.5rem;">
                  <cite>Para pago con tarjeta solicíta el link de pago, comisión incluida del</cite> 5%: <b>${{ Sistema::dosDecimales($cotizacion->tot*1.05) }}</b>
                </p>
              @endif
            </td>
            <td id="cot" title="Da click en la serie para ver los datalles de la cotización">
              <a href="{{ route('rolCliente.cotizacion.show', Crypt::encrypt($cotizacion->id)) }}" title="Detalles: {{ $cotizacion->serie }}">{{ $cotizacion->serie }}</a>
            </td>
            @include('cotizacion.cot_table.td.numPedGen')
            @include('cotizacion.cot_table.td.estatus')
            @include('cotizacion.cot_table.td.validez')
            @include('cotizacion.cot_table.td.total')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>

@section('js5')
<script>
  $('#cot').tooltip('show');
</script>
@endsection