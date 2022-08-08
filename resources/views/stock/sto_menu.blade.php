@canany(['stock.index', 'stock.create', 'stock.show', 'stock.edit', 'stock.destroy'])
  <li class="nav-item">
    <a href="{{ route('stock.index') }}" class="nav-link {{ Request::is('stock') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de stock') }}
    </a>
  </li>
@endcanany
@can('stock.create')
  <li class="nav-item">
    <a href="{{ route('stock.create') }}" class="nav-link {{ Request::is('stock/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar stock') }}
    </a>
  </li>
@endcan