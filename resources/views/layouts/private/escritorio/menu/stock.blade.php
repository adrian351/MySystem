@canany(['stock.index', 'stock.create', 'stock.show', 'stock.edit', 'stock.destroy'])
  <li class="nav-item has-treeview {{ Request::is('stock*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('stock*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-warehouse"></i>
      <p>
        {{ __('Stock') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['stock.index', 'stock.create', 'stock.show', 'stock.edit', 'stock.destroy'])
        <li class="nav-item">
          <a href="{{ route('stock.index') }}" class="nav-link {{ Request::is('stock') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de stock') }}</p>
          </a>
        </li>
      @endcanany
      @can('stock.create')
        <li class="nav-item">
          <a href="{{ route('stock.create') }}" class="nav-link {{ Request::is('stock/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar stock') }}</p>
          </a>
        </li>
      @endcan
    </ul>
  </li>
@endcanany