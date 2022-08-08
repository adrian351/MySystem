@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Inicio almacén'))</title>
<div class="row">
  @canany([
    'almacen.pedidoActivo.index', 'almacen.pedidoActivo.show', 'almacen.pedidoActivo.edit', 'almacen.pedidoActivo.armado.show', 'almacen.pedidoActivo.armado.edit',
    'almacen.pedidoTerminado.index','almacen.pedidoTerminado.show'
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
              @canany(['almacen.pedidoActivo.index', 'almacen.pedidoActivo.show', 'almacen.pedidoActivo.edit', 'almacen.pedidoActivo.armado.show', 'almacen.pedidoActivo.armado.edit',])
                <a href="{{ route('almacen.pedidoActivo.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos activos') }}</a>
              @endcanany
              @canany(['almacen.pedidoTerminado.index','almacen.pedidoTerminado.show'])
                <a href="{{ route('almacen.pedidoTerminado.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos terminados') }} (-90d)</a>
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
  @canany(['almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.editValidado', 'almacen.producto.editHabilitado', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy'])    
    <div class="col-lg-3">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ __('Productos') }}</h3>
          <div class="btn-group">
            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('Ver más') }}
            </a>
            <div class="dropdown-menu">
              @canany(['almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.editValidado', 'almacen.producto.editHabilitado', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy'])
                <a href="{{ route('almacen.producto.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de productos') }}</a>
              @endcanany
              @can('almacen.producto.create')
                <a href="{{ route('almacen.producto.create') }}" class="dropdown-item"><i class="far fa-plus-square"></i> {{ __('Registrar producto') }}</a>
              @endcan
            </div>
          </div>
        </div>
        <div class="icon">
          <i class="fab fa-product-hunt"></i>
        </div>
      </div>
    </div>
  @endcanany
</div>
@endsection