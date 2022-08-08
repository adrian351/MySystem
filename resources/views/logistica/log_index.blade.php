@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Inicio logística'))</title>
<div class="row">
  @canany([
    'logistica.pedidoActivo.index', 'logistica.pedidoActivo.show', 'logistica.pedidoActivo.edit', 'logistica.pedidoActivo.armado.show', 'logistica.pedidoActivo.armado.edit',
    'logistica.direccionLocal.index', 'logistica.direccionLocal.show', 'logistica.direccionLocal.create', 'logistica.direccionLocal.createEntrega',
    'logistica.direccionForaneo.index', 'logistica.direccionForaneo.show', 'logistica.direccionForaneo.create', 'logistica.direccionForaneo.createEntrega',
    'logistica.pedidoEntregado.index','logistica.pedidoEntregado.show',
    'logistica.direccionLocal.edit', 'logistica.direccionForaneo.edit',
    'logistica.direccionEntregada.edit'
  ])
    <div class="col-lg-3">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ __('Pedidos') }}</h3>
          <div class="btn-group">
            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('Ver más') }}
            </a>
            <div class="dropdown-menu">
              @canany(['logistica.pedidoActivo.index','logistica.pedidoActivo.show','logistica.pedidoActivo.edit', 'logistica.pedidoActivo.armado.show', 'logistica.pedidoActivo.armado.edit'])
                <a href="{{ route('logistica.pedidoActivo.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos activos') }}</a>
              @endcanany
              @canany(['logistica.direccionLocal.index', 'logistica.direccionLocal.show', 'logistica.direccionLocal.create', 'logistica.direccionLocal.createEntrega', 'logistica.direccionLocal.edit'])
                <a href="{{ route('logistica.direccionLocal.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de direcciones locales') }}</a>
              @endcanany
              @canany(['logistica.direccionForaneo.index', 'logistica.direccionForaneo.show', 'logistica.direccionForaneo.create', 'logistica.direccionForaneo.createEntrega', 'logistica.direccionForaneo.edit'])
                <a href="{{ route('logistica.direccionForaneo.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de direcciones foráneos') }}</a>
              @endcanany
              @canany(['logistica.pedidoEntregado.index','logistica.pedidoEntregado.show'])
                <a href="{{ route('logistica.pedidoEntregado.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos entregados') }} (-90d)</a>
              @endcanany
              @canany(['logistica.pedidoEntregado.index','logistica.pedidoEntregado.show', 'logistica.direccionEntregada.edit'])
                <a href="{{ route('logistica.direccionEntregada.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de direcciones entregadas') }} (-90d)</a>
              @endcanany
            </div>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-shopping-bag"></i>
        </div>
      </div>
    </div>
  @endcanany
</div>
@endsection