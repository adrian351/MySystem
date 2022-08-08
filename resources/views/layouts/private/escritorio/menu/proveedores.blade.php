@canany(['proveedor.index', 'proveedor.create', 'proveedor.show', 'proveedor.edit', 'proveedor.destroy', 'proveedor.editValidado', 'proveedor.contacto.index', 'proveedor.contacto.create', 'proveedor.contacto.show', 'proveedor.contacto.edit', 'proveedor.contacto.destroy'])
  <li class="nav-item has-treeview {{ Request::is('proveedor*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('proveedor*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-handshake"></i>
      <p>
        {{ __('Proveedores') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['proveedor.index', 'proveedor.create', 'proveedor.show', 'proveedor.edit', 'proveedor.destroy', 'proveedor.editValidado', 'proveedor.contacto.index', 'proveedor.contacto.create', 'proveedor.contacto.show', 'proveedor.contacto.edit', 'proveedor.contacto.destroy'])
        <li class="nav-item">
          <a href="{{ route('proveedor.index') }}" class="nav-link {{ Request::is('proveedor') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de proveedores') }}</p>
          </a>
        </li>
      @endcanany
      @can('proveedor.create')
        <li class="nav-item">
          <a href="{{ route('proveedor.create') }}" class="nav-link {{ Request::is('proveedor/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar proveedor') }}</p>
          </a>
        </li>
      @endcan
    </ul>
  </li>
@endcanany