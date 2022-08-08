@canany(['material.index', 'material.create', 'material.show', 'material.edit', 'material.destroy', 'material.consultarPrecio'])
  <li class="nav-item has-treeview {{ Request::is('material*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('material*') ? 'active' : '' }}">
      <i class="nav-icon fab fa-product-hunt"></i>
      <p>
        {{ __('Materiales') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['material.index', 'material.create', 'material.show', 'material.edit', 'material.destroy'])
        <li class="nav-item">
          <a href="{{ route('material.index') }}" class="nav-link {{ Request::is('material') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de materiales') }}</p>
          </a>
        </li>
      @endcanany
      @can('material.create')
        <li class="nav-item">
          <a href="{{ route('material.create') }}" class="nav-link {{ Request::is('material/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar material') }}</p>
          </a>
        </li>
      @endcan
      @can('material.consultarPrecio')
        <li class="nav-item">
          <a href="{{ route('material.consultarPrecio') }}" class="nav-link {{ Request::is('material/consultar-precio') ? 'active' : '' }}">
            <i class="nav-icon fas fa-search"></i>
            <p>{{ __('Consultar precio') }}</p>
          </a>
        </li>
      @endcan
    </ul>
  </li>
@endcanany