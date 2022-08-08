@canany(['rol.index', 'rol.create', 'rol.show', 'rol.edit', 'rol.destroy'])
  <li class="nav-item">
    <a href="{{ route('rol.index') }}" class="nav-link {{ Request::is('rol') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de roles') }}
    </a>
  </li>
@endcanany
@canany(['rol.permiso.index', 'rol.create', 'rol.show', 'rol.edit'])
  <li class="nav-item">
    <a href="{{ route('rol.permiso.index') }}" class="nav-link {{ Request::is('rol/permiso') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de permisos') }}
    </a>
  </li>
@endcanany
@can('rol.create')
  <li class="nav-item">
    <a href="{{ route('rol.create') }}" class="nav-link {{ Request::is('rol/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar rol') }}
    </a>
  </li>
@endcan