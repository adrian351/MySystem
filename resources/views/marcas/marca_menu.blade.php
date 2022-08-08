@canany(['marca.index', 'marca.create', 'marca.edit', 'marca.destroy'])
  <li class="nav-item">
    <a href="{{ route('marca.index') }}" class="nav-link {{ Request::is('marca') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de marcas') }}
    </a>
  </li>
@endcanany
@can('marca.create')
  <li class="nav-item">
    <a href="{{ route('marca.create') }}" class="nav-link {{ Request::is('marca/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar marca') }}
    </a>
  </li>
@endcan