@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Inicio ventas'))</title>
@canany(['venta.pedidoActivo.index', 'venta.pedidoActivo.show', 'venta.pedidoActivo.edit', 'venta.pedidoActivo.destroy', 'venta.pedidoActivo.armado.show' ,'venta.pedidoActivo.armado.edit', 'venta.pedidoActivo.pago.create', 'venta.pedidoActivo.pago.show', 'venta.pedidoActivo.pago.edit', 'venta.pedidoTerminado.index', 'venta.pedidoTerminado.show'])
  <div class="row">
    <div class="col-lg-2">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ __('Pedidos') }}</h3>
          <div class="btn-group">
            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('Ver más') }}
            </a>
            <div class="dropdown-menu">
              @canany(['venta.pedidoActivo.index', 'venta.pedidoActivo.show', 'venta.pedidoActivo.edit', 'venta.pedidoActivo.destroy', 'venta.pedidoActivo.armado.show' ,'venta.pedidoActivo.armado.edit', 'venta.pedidoActivo.pago.create', 'venta.pedidoActivo.pago.show', 'venta.pedidoActivo.pago.edit'])
                <a href="{{ route('venta.pedidoActivo.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos activos') }}</a>
              @endcanany
              @canany(['venta.pedidoTerminado.index', 'venta.pedidoTerminado.show'])
                <a href="{{ route('venta.pedidoTerminado.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos terminados') }}</a>
              @endcanany
            </div>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-shopping-bag"></i>
        </div>
      </div>
    </div>
  </div>
@endcanany
@endsection