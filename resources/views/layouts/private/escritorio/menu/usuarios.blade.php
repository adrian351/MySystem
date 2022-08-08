@canany(['usuario.index', 'usuario. ', 'usuario.show', 'usuario.edit', 'usuario.destroy'])
  <li class="nav-item has-treeview {{ Request::is('usuario*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('usuario*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-users"></i>
      <p>
        {{ __('Usuarios') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['usuario.index', 'usuario.create', 'usuario.show', 'usuario.edit', 'usuario.destroy'])
        <li class="nav-item">
          <a href="{{ route('usuario.index') }}" class="nav-link {{ Request::is('usuario') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de usuarios') }}</p>
          </a>
        </li>
      @endcanany
      @can('usuario.create')
        <li class="nav-item">
          <a href="{{ route('usuario.create') }}" class="nav-link {{ Request::is('usuario/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar usuario') }}</p>
          </a>
        </li>
        @endcan
    </ul>
  </li>
@endcanany