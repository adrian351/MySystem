@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Inicio TI'))</title>
<div class="row">
  @canany(['soporte.index', 'soporte.show', 'soporte.edit', 'soporte.destroy'])
    <div class="col-lg-3">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ __('Lista de soportes') }}</h3>
          <div class="btn-group">
            <a href="{{ route('soporte.index') }}" class="btn btn-info">
              {{ __('Lista de soportes') }}
            </a>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-list"></i>
        </div>
      </div>
    </div>
  @endcanany
  @canany(['inventario.edit', 'inventario.index', 'inventario.create', 'inventario.show', 'inventario.destroy'])
    <div class="col-lg-3">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ __('Inventario') }}</h3>
          <div class="btn-group">
            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('Ver más') }}
            </a>
            <div class="dropdown-menu">
              @canany(['inventario.edit', 'inventario.index', 'inventario.create', 'inventario.show', 'inventario.destroy'])
                <a href="{{ route('inventario.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de inventario') }}</a>
              @endcanany
              @can('inventario.create')
                <a href="{{ route('inventario.create') }}" class="dropdown-item"><i class="far fa-plus-square"></i> {{ __('Registrar inventario') }}</a>
              @endcan
            </div>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-dolly-flatbed"></i>
        </div>
      </div>
    </div>
  @endcanany
</div>
@endsection