@canany(['proveedor.index', 'proveedor.create', 'proveedor.show', 'proveedor.edit', 'proveedor.destroy', 'proveedor.editValidado', 'proveedor.contacto.index', 'proveedor.contacto.create', 'proveedor.contacto.show', 'proveedor.contacto.edit', 'proveedor.contacto.destroy'])
  <li class="nav-item">
    <a href="{{ route('proveedor.index') }}" class="nav-link {{ Request::is('proveedor') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de proveedores') }}
    </a>
  </li>
@endcanany
@can('proveedor.create')
  <li class="nav-item">
    <a href="{{ route('proveedor.create') }}" class="nav-link {{ Request::is('proveedor/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar proveedor') }}
    </a>
  </li>
@endcan