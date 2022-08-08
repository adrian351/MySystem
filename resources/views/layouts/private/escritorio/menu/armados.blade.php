@canany(['armado.index', 'armado.create', 'armado.show', 'armado.edit','armado.catalogo.select', 'armado.destroy', 'armado.clon.index', 'armado.clon.create', 'armado.clon.show', 'armado.clon.edit', 'armado.clon.destroy', 'armado.producto.create', 'armado.producto.destroy', 'armado.producto.editCantidad', 'armado.clon.producto.create', 'armado.clon.producto.destroy', 'armado.clon.producto.editCantidad'])
  <li class="nav-item has-treeview {{ Request::is('armado*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('armado*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-shopping-basket"></i>
      <p>
        {{ __('Armados') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['armado.index', 'armado.create', 'armado.show', 'armado.edit','armado.catalogo.select', 'armado.destroy', 'armado.clon.create', 'armado.producto.create', 'armado.producto.destroy', 'armado.producto.editCantidad'])
        <li class="nav-item ">
          <a href="{{ route('armado.index') }}" class="nav-link {{ Request::is('armado') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de armados') }}</p>
          </a>
        </li>
      @endcanany
      @can('armado.create')
        <li class="nav-item">
          <a href="{{ route('armado.create') }}" class="nav-link {{ Request::is('armado/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar armado') }}</p>
          </a>
        </li>
      @endcan
      @canany(['armado.clon.index', 'armado.clon.create', 'armado.clon.show', 'armado.clon.edit', 'armado.clon.destroy', 'armado.clon.producto.create', 'armado.clon.producto.destroy', 'armado.clon.producto.editCantidad'])
        <li class="nav-item">
          <a href="{{ route('armado.clon.index') }}" class="nav-link {{ Request::is('armado/clon') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de armados clonados') }}</p>
          </a>
        </li>
      @endcanany
    </ul>
  </li>
@endcanany