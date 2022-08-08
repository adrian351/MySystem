@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Inicio producción'))</title>
<div class="row">
  @canany([
    'produccion.pedidoActivo.index', 'produccion.pedidoActivo.show', 'produccion.pedidoActivo.edit', 'produccion.pedidoActivo.armado.show', 'produccion.pedidoActivo.armado.edit',
    'produccion.pedidoTerminado.index','produccion.pedidoTerminado.show'
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
              @canany(['produccion.pedidoActivo.index', 'produccion.pedidoActivo.show', 'produccion.pedidoActivo.edit', 'produccion.pedidoActivo.armado.show', 'produccion.pedidoActivo.armado.edit',])
                <a href="{{ route('produccion.pedidoActivo.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos activos') }}</a>
              @endcanany
              @canany(['produccion.pedidoTerminado.index','produccion.pedidoTerminado.show'])
                <a href="{{ route('produccion.pedidoTerminado.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos terminados') }} (-90d)</a>
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