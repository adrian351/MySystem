@canany(['categoria.index', 'categoria.create', 'categoria.edit', 'categoria.destroy'])
  <li class="nav-item">
    <a href="{{ route('categoria.index') }}" class="nav-link {{ Request::is('categoria') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de categorias') }}
    </a>
  </li>
@endcanany
@can('categoria.create')
  <li class="nav-item">
    <a href="{{ route('categoria.create') }}" class="nav-link {{ Request::is('categoria/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar categoria') }}
    </a>
  </li>
@endcan