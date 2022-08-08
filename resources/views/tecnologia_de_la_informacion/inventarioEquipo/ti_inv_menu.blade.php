@canany(['inventario.index', 'inventario.create', 'inventario.show', 'inventario.edit', 'inventario.destroy', 'inventario.archivo.store', 'inventario.archivo.destroy', 'inventario.historial.store', 'inventario.historial.show'])
  <li class="nav-item">
    <a href="{{ route('inventario.index') }}" class="nav-link {{Request::is('ti/inventario') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de inventario') }}
    </a>
  </li>
@endcanany
@can('inventario.create')
  <li class="nav-item">
    <a href="{{ route('inventario.create') }}" class="nav-link {{ Request::is('ti/inventario/crear') ? 'active' : ''}}">
      <i class="fas fa-plus-square"></i> {{__('Registrar inventario')}}
    </a>
  </li>
@endcan

<li class="nav-item ml-auto">
  <a href="{{ route('inventario.generarReporte') }}" class="btn btn-info" target="_blank">
    {{__('Generar reporte')}}
  </a>
</li>