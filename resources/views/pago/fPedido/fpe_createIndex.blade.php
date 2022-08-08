@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar pago al pedido').' '.$pedido->num_pedido)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5><strong>{{ __('Registrar pago al pedido') }}:</strong> {{ $pedido->num_pedido }}</h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>
@canany(['pago.fPedido.create', 'venta.pedidoActivo.pago.create'])
  <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      <ul class="nav nav-pills nav-fill border">
        <li class="nav-item">
          <a href="{{ route('pago.fPedido.create', Crypt::encrypt($pedido->id)) }}" class="nav-link {{ Request::is('pago/f-pedido/registrar*') ? 'active' : '' }}">{{ __('Registrar pago') }}</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pago.fPedido.generarCodigo', Crypt::encrypt($pedido->id)) }}" class="nav-link {{ Request::is('pago/f-pedido/generar-codigo*') ? 'active' : '' }}">{{ __('Generar código de facturación') }}</a>
        </li>
      </ul>
      @yield('createPago')
    </div>
  </div>
@endcanany
@include('pago.fPedido.pago.pag_index')
@endsection

@include('layouts.private.plugins.priv_plu_select2')
@section('js5')
<script>
  @if(Request::route()->getName() == 'pago.fPedido.create')
    window.onload = function() { 
      getFormaDePago();
    }
  @endif
  function getFormaDePago() {
    selectFormaDePago           = document.getElementById("forma_de_pago"),
    forma_de_pago               = selectFormaDePago.value;
    div_copia_de_identificacion = document.getElementById('div_copia_de_identificacion');
    div_ultimos_8_digitos_del_folio_de_pago = document.getElementById('div_ultimos_8_digitos_del_folio_de_pago');


    if(forma_de_pago == 'Paypal' || forma_de_pago == 'Tarjeta de credito (Pagina)') {
      div_copia_de_identificacion.style.display = 'block';
    } else {
      div_copia_de_identificacion.style.display = 'none';
    }

    if(forma_de_pago != 'Efectivo (Jonathan)' && forma_de_pago != 'Efectivo (Gabriel)' && forma_de_pago != 'Efectivo (Fernando)' && forma_de_pago != 'Efectivo (Muestras/Garantías)' && forma_de_pago != '') {
      div_ultimos_8_digitos_del_folio_de_pago.style.display = 'block';
    } else {
      div_ultimos_8_digitos_del_folio_de_pago.style.display = 'none';
    }
  }
  function getMontoDelPago() {
    monto_del_pago = document.getElementById("monto_del_pago").value;
    if (isNaN(parseFloat(monto_del_pago))) {
      monto_del_pago = 0;
    }
    monto_del_pago = Number.parseFloat(monto_del_pago).toFixed(2);
    document.getElementById("monto_del_pago").value = monto_del_pago
  }
</script>
@endsection