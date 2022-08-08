@canany(['cliente.index', 'cliente.create', 'cliente.show', 'cliente.edit', 'cliente.destroy'])
  <li class="nav-item has-treeview {{ Request::is('cliente*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('cliente*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-user-tie"></i>
      <p>
        {{ __('Clientes') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['cliente.index', 'cliente.create', 'cliente.show', 'cliente.edit', 'cliente.destroy'])
        <li class="nav-item">
          <a href="{{ route('cliente.index') }}" class="nav-link {{ Request::is('cliente') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de clientes') }}</p>
          </a>
        </li>
      @endcanany
      @can('cliente.create')
        <li class="nav-item">
          <a href="{{ route('cliente.create') }}" class="nav-link {{ Request::is('cliente/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar cliente') }}</p>
          </a>
        </li>
      @endcan
    </ul>
  </li>
@endcanany