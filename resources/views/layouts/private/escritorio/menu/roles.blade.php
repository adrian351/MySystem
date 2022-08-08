@canany(['rol.permiso.index', 'rol.index', 'rol.create', 'rol.show', 'rol.edit', 'rol.destroy'])
  <li class="nav-item has-treeview {{ Request::is('rol*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('rol*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-dice-six"></i>
      <p>
        {{ __('Roles') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['rol.index', 'rol.create', 'rol.show', 'rol.edit', 'rol.destroy'])
        <li class="nav-item">
          <a href="{{ route('rol.index') }}" class="nav-link {{ Request::is('rol') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de roles') }}</p>
          </a>
        </li>
      @endcanany
      @canany(['rol.permiso.index', 'rol.create', 'rol.show', 'rol.edit'])
      <li class="nav-item">
        <a href="{{ route('rol.permiso.index') }}" class="nav-link {{ Request::is('rol/permiso') ? 'active' : '' }}">
          <i class="nav-icon fas fa-list"></i>
          <p>{{ __('Lista de permisos') }}</p>
        </a>
      </li>
    @endcanany
      @can('rol.create')
        <li class="nav-item">
          <a href="{{ route('rol.create') }}" class="nav-link {{ Request::is('rol/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar rol') }}</p>
          </a>
        </li>
        @endcan
    </ul>
  </li>
@endcanany