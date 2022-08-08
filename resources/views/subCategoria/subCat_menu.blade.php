@canany(['subCategoria.index', 'subCategoria.create', 'subCategoria.edit', 'subCategoria.destroy'])
  <li class="nav-item">
    <a href="{{ route('subCategoria.index') }}" class="nav-link {{ Request::is('subCategoria') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de SubCategorias') }}
    </a>
  </li>
@endcanany
@can('subCategoria.create')
  <li class="nav-item">
    <a href="{{ route('subCategoria.create') }}" class="nav-link {{ Request::is('subCategoria/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar SubCategoria') }}
    </a>
  </li>
@endcan